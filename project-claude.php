<?php

namespace App\Config;

class DatabaseConfig
{
    public const BASE_DIR = "/painel-v2/public";

    // Configurações do Moodle
    public const MOODLE_TOKEN = '0aa4e9bac2c22fa65beeb720d3a5fb41';
    public const MOODLE_DOMAIN = 'https://directweb.eduead.com.br/moodle40/';
    
    // Configurações do banco de dados
    public const DB_DRIVER = 'mysql';
    public const DB_HOST = '127.0.0.1';
    public const DB_PORT = '3306';
    public const DB_DATABASE = 'painel';
    public const DB_USER = 'painel';
    public const DB_PASS = 'painel';
    public const DB_CHARSET = 'utf8mb4';
    
    // Configurações de conexão
    public const DB_TIMEOUT = 5;
    public const DB_RETRY_ATTEMPTS = 3;
}

<?php

namespace Core\Database;

use App\Config\DatabaseConfig;
use PDO;
use PDOException;
use RuntimeException;

class Connection
{
    private static ?PDO $instance = null;
    private static int $retryAttempts = 0;

    private function __construct() {}
    private function __clone() {}

    public function __wakeup(): void
    {
        throw new RuntimeException('Cannot unserialize singleton');
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::createConnection();
        }

        return self::$instance;
    }

    private static function createConnection(): void
    {
        $maxRetries = DatabaseConfig::DB_RETRY_ATTEMPTS;
        
        while (self::$retryAttempts < $maxRetries) {
            try {
                $dsn = self::buildDsn();
                
                self::$instance = new PDO(
                    $dsn,
                    DatabaseConfig::DB_USER,
                    DatabaseConfig::DB_PASS,
                    self::getDefaultOptions()
                );

                // Reset retry counter on successful connection
                self::$retryAttempts = 0;
                return;

            } catch (PDOException $e) {
                self::$retryAttempts++;
                
                if (self::$retryAttempts >= $maxRetries) {
                    self::handleConnectionError($e);
                }
                
                // Wait before retrying
                sleep(1);
            }
        }
    }

    private static function buildDsn(): string
    {
        return sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
            DatabaseConfig::DB_DRIVER,
            DatabaseConfig::DB_HOST,
            DatabaseConfig::DB_PORT,
            DatabaseConfig::DB_DATABASE,
            DatabaseConfig::DB_CHARSET
        );
    }

    private static function handleConnectionError(PDOException $e): void
    {
        $message = "Database connection failed";
        
        // Log error details
        error_log("Database Connection Error: " . $e->getMessage());
        
        // Don't expose sensitive information in production
        if (self::isProduction()) {
            throw new RuntimeException($message);
        }
        
        throw new RuntimeException($message . ': ' . $e->getMessage());
    }

    private static function getDefaultOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            PDO::ATTR_TIMEOUT => DatabaseConfig::DB_TIMEOUT,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DatabaseConfig::DB_CHARSET,
            PDO::MYSQL_ATTR_FOUND_ROWS => true,
        ];
    }

    private static function isProduction(): bool
    {
        return defined('APP_ENV') && APP_ENV === 'production';
    }

    public static function disconnect(): void
    {
        self::$instance = null;
        self::$retryAttempts = 0;
    }
}

<?php

namespace App\Traits;

use Core\Database\Connection;
use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use ClanCats\Hydrahon\Query\Sql\Insert;
use InvalidArgumentException;

trait DatabaseOperations
{
    protected static ?Builder $queryBuilder = null;
    
    public function __construct()
    {
        self::initializeQueryBuilder();
    }

    public static function initializeQueryBuilder(): void
    {
        if (self::$queryBuilder === null) {
            try {
                $connection = Connection::getInstance();
                
                self::$queryBuilder = new Builder('mysql', function($query, $queryString, $queryParameters) use($connection) {
                    $statement = $connection->prepare($queryString);
                    $statement->execute($queryParameters);

                    if ($query instanceof FetchableInterface) {
                        return $statement->fetchAll(PDO::FETCH_ASSOC);
                    } elseif ($query instanceof Insert) {
                        return $connection->lastInsertId();
                    } else {
                        return $statement->rowCount();
                    }   
                });

            } catch (\Exception $e) {
                throw new \RuntimeException('Failed to initialize query builder: ' . $e->getMessage());
            }
        } 
    }

    protected function select($columns = ['*'], string $table = null)
    {
        self::initializeQueryBuilder();
        
        $tableName = $table ?? $this->getTableName();
        
        if (!is_array($columns)) {
            $columns = [$columns];
        }

        return self::$queryBuilder->table($tableName)->select($columns);
    }

    protected function update(string $table = null)
    {
        self::initializeQueryBuilder();
        
        $tableName = $table ?? $this->getTableName();
        
        return self::$queryBuilder->table($tableName)->update();
    }

    protected function insert(array $data, string $table = null)
    {
        self::initializeQueryBuilder();
        
        if (empty($data)) {
            throw new InvalidArgumentException('Insert data cannot be empty');
        }
        
        $tableName = $table ?? $this->getTableName();
        
        return self::$queryBuilder->table($tableName)->insert($data)->execute();
    }

    protected function delete(string $table = null)
    {
        self::initializeQueryBuilder();
        
        $tableName = $table ?? $this->getTableName();
        
        return self::$queryBuilder->table($tableName)->delete();
    }

    protected function getTableName(): string
    {
        if (!property_exists($this, 'table')) {
            throw new \RuntimeException('Table name not defined in model');
        }
        
        return $this->table;
    }
}

<?php

namespace Core;

use App\Traits\DatabaseOperations;
use InvalidArgumentException;

abstract class Model
{
    use DatabaseOperations;

    protected string $table;
    protected array $fillable = [];
    protected array $hidden = [];

    public function find(string $field, $value): array
    {
        $this->validateField($field);
        
        return $this->select([$field])
            ->where($field, $value)
            ->get();
    }

    public function findById(int $id): ?array
    {
        $result = $this->select()
            ->where('id', $id)
            ->get();
            
        return $result[0] ?? null;
    }

    public function exists(string $field, $value, string $excludeField = 'id', $excludeValue = null): bool
    {
        $this->validateField($field);
        
        $query = $this->select([$field])
            ->where($field, $value);
            
        if ($excludeValue !== null) {
            $query->where($excludeField, '<>', $excludeValue);
        }
        
        return !empty($query->get());
    }

    public function search(array $fields, string $value): array
    {
        if (empty($fields)) {
            throw new InvalidArgumentException('Search fields cannot be empty');
        }
        
        $query = $this->select($fields);
        
        foreach ($fields as $field) {
            $this->validateField($field);
            $query->orWhere($field, 'like', '%' . $this->sanitizeSearchValue($value) . '%');
        }

        return $query->get();
    }

    public function create(array $data): int
    {
        $this->validateData($data);
        $filteredData = $this->filterFillable($data);
        
        return $this->insert([$filteredData]);
    }

    public function updateById(int $id, array $data): int
    {
        $this->validateData($data);
        $filteredData = $this->filterFillable($data);
        
        return $this->update()
            ->set($filteredData)
            ->where('id', $id)
            ->execute();
    }

    public function deleteById(int $id): int
    {
        return $this->delete()
            ->where('id', $id)
            ->execute();
    }

    protected function validateField(string $field): void
    {
        if (empty($field)) {
            throw new InvalidArgumentException('Field name cannot be empty');
        }
    }

    protected function validateData(array $data): void
    {
        if (empty($data)) {
            throw new InvalidArgumentException('Data cannot be empty');
        }
    }

    protected function filterFillable(array $data): array
    {
        if (empty($this->fillable)) {
            return $data;
        }
        
        return array_intersect_key($data, array_flip($this->fillable));
    }

    protected function sanitizeSearchValue(string $value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
}

<?php

namespace Core;

use App\Traits\ViewRenderer;

abstract class Controller
{
    use ViewRenderer;
    
    protected function validateRequest(array $data, array $rules): array
    {
        // Implementar validação básica
        foreach ($rules as $field => $rule) {
            if (strpos($rule, 'required') !== false && empty($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }
        
        return $data;
    }
    
    protected function jsonResponse(array $data, int $statusCode = 200): array
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        
        return $data;
    }
    
    protected function redirectTo(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}

<?php

namespace App\Services;

class PaginationService
{
    private int $perPage;
    private int $currentPage;
    private int $totalRecords;

    public function __construct(int $perPage = 10)
    {
        $this->perPage = max(1, $perPage);
        $this->currentPage = max(1, (int)($_GET['page'] ?? 1));
    }

    public function paginate(array $data): array
    {
        $this->totalRecords = count($data);
        $offset = ($this->currentPage - 1) * $this->perPage;
        $totalPages = (int)ceil($this->totalRecords / $this->perPage);

        $paginatedData = array_slice($data, $offset, $this->perPage);

        return [
            'data' => $paginatedData,
            'pagination' => [
                'current_page' => $this->currentPage,
                'per_page' => $this->perPage,
                'total_pages' => $totalPages,
                'total_records' => $this->totalRecords,
                'has_previous' => $this->currentPage > 1,
                'has_next' => $this->currentPage < $totalPages,
                'previous_page' => $this->currentPage > 1 ? $this->currentPage - 1 : null,
                'next_page' => $this->currentPage < $totalPages ? $this->currentPage + 1 : null,
            ]
        ];
    }
}

<?php

namespace App\Services;

class PasswordService
{
    private const DEFAULT_COST = 12;

    public static function hash(string $password): string
    {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters long');
        }

        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3,
        ]);
    }

    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3,
        ]);
    }
}

<?php

namespace App\Models;

use Core\Model;
use App\Services\PaginationService;
use App\Services\PasswordService;

class User extends Model
{
    protected string $table = 'tbl_user';
    protected array $fillable = ['firstname', 'lastname', 'email', 'password'];
    protected array $hidden = ['password'];

    public function getAll(int $perPage = 10): array
    {
        $users = $this->select([
            'u.id', 
            'u.firstname', 
            'u.lastname', 
            'u.email', 
            'r.name as role'
        ], 'tbl_user_role as ur')
        ->innerJoin("{$this->table} as u", 'u.id', '=', 'ur.user_id')
        ->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
        ->orderBy('u.id')
        ->get();

        $paginationService = new PaginationService($perPage);
        $paginatedResult = $paginationService->paginate($users);
        
        return [
            'users' => $paginatedResult['data'],
            'pagination' => $paginatedResult['pagination']
        ];
    }

    public function createUser(array $userData): array
    {
        if (empty($userData['password'])) {
            throw new \InvalidArgumentException('Password is required');
        }
        
        // Hash password
        $userData['password'] = PasswordService::hash($userData['password']);
        
        $roleId = $userData['role_id'];
        unset($userData['role_id']);

        // Insert user
        $userId = $this->create($userData);

        // Insert user role
        $userRole = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];
        
        $roleResult = $this->insert([$userRole], 'tbl_user_role');

        return [
            'user_id' => $userId,
            'role_result' => $roleResult
        ];
    }

    public function getUserById(int $id): array
    {
        $user = $this->select([
            'u.id', 
            'u.firstname', 
            'u.lastname', 
            'u.email', 
            'r.id as role_id'
        ], 'tbl_user_role as ur')
        ->innerJoin("{$this->table} as u", 'u.id', '=', 'ur.user_id')
        ->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
        ->where('u.id', $id)
        ->get();

        if (empty($user)) {
            throw new \Exception("User not found");
        }

        return $user[0];
    }

    public function searchByCredentials(string $field, string $value): array
    {
        return $this->select([
            'u.id',
            'u.firstname',
            'u.lastname',
            'u.email',
            'u.password',
            'r.id as role_id',
            'r.name as role_name'
        ], 'tbl_user_role as ur')
        ->innerJoin('tbl_user as u', 'u.id', '=', 'ur.user_id')
        ->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
        ->where("u.{$field}", $value)
        ->get();
    }

    public function updateUser(int $id, array $userData): array
    {
        $roleId = $userData['role_id'];
        unset($userData['role_id']);

        // Update user data
        $userResult = $this->updateById($id, $userData);

        // Update user role
        $roleResult = $this->update('tbl_user_role')
            ->set(['role_id' => $roleId])
            ->where('user_id', $id)
            ->execute();

        return [
            'user_updated' => $userResult,
            'role_updated' => $roleResult
        ];
    }

    public function deleteUser(int $id): array
    {
        // Delete user role first (foreign key constraint)
        $roleDeleted = $this->delete('tbl_user_role')
            ->where('user_id', $id)
            ->execute();

        // Delete user
        $userDeleted = $this->deleteById($id);

        return [
            'role_deleted' => $roleDeleted,
            'user_deleted' => $userDeleted
        ];
    }

    public function searchUsers(array $fields, string $value, int $perPage = 10): array
    {
        $users = $this->search($fields, $value);
        
        $paginationService = new PaginationService($perPage);
        $paginatedResult = $paginationService->paginate($users);
        
        return [
            'users' => $paginatedResult['data'],
            'pagination' => $paginatedResult['pagination']
        ];
    }
}

<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Core\Controller;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    private User $userModel;
    private Role $roleModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }

    public function index(Request $request, Response $response): Response
    {
        try {
            $perPage = 10;
            $searchTerm = $_GET['search'] ?? null;

            if ($searchTerm) {
                $result = $this->userModel->searchUsers(
                    ['firstname', 'lastname', 'email'], 
                    $searchTerm, 
                    $perPage
                );
            } else {
                $result = $this->userModel->getAll($perPage);
            }

            $this->view('pages/users.html', [
                'title' => 'User List',
                'users' => $result['users'],
                'pagination' => $result['pagination'],
                'search_term' => $searchTerm
            ]);

        } catch (\Exception $e) {
            $this->handleError($e, 'Error loading users');
        }

        return $response;
    }

    public function create(Request $request, Response $response): Response
    {
        try {
            $roles = $this->roleModel->getRoles();
            
            $this->view('pages/user-create.html', [
                'title' => 'Create New User',
                'roles' => $roles,
                'cookie_data' => $_COOKIE
            ]);

        } catch (\Exception $e) {
            $this->handleError($e, 'Error loading create form');
            $this->redirectTo('/admin/users');
        }

        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        try {
            $data = $this->validateUserData($request->getParsedBody());
            
            $this->userModel->createUser($data);
            
            $this->setFlashMessage('success', 'User created successfully');
            
        } catch (\Exception $e) {
            $this->handleError($e, 'Error creating user');
        }

        $this->redirectTo('/admin/users');
        return $response;
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        try {
            $user = $this->userModel->getUserById((int)$args['id']);
            $roles = $this->roleModel->getRoles();

            $this->view('pages/user-update.html', [
                'title' => 'Edit User',
                'user' => $user,
                'roles' => $roles,
                'cookie_data' => $_COOKIE
            ]);

        } catch (\Exception $e) {
            $this->handleError($e, 'Error loading user');
            $this->redirectTo('/admin/users');
        }

        return $response;
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        try {
            $data = $this->validateUserData($request->getParsedBody(), (int)$args['id']);
            
            $this->userModel->updateUser((int)$args['id'], $data);
            
            $this->setFlashMessage('success', 'User updated successfully');
            
        } catch (\Exception $e) {
            $this->handleError($e, 'Error updating user');
        }

        $this->redirectTo('/admin/users');
        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        try {
            $this->userModel->deleteUser((int)$args['id']);
            
            $this->setFlashMessage('success', 'User deleted successfully');
            
        } catch (\Exception $e) {
            $this->handleError($e, 'Error deleting user');
        }

        $this->redirectTo('/admin/users');
        return $response;
    }

    private function validateUserData(array $data, int $excludeId = null): array
    {
        $rules = [
            'firstname' => 'required|max:30',
            'lastname' => 'required|max:30',
            'email' => 'required|email|max:60',
            'role_id' => 'required|integer'
        ];

        if ($excludeId === null) {
            $rules['password'] = 'required|min:8|max:100';
        }

        // Basic validation
        foreach ($rules as $field => $rule) {
            if (strpos($rule, 'required') !== false && empty($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }

        // Email validation
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }

        // Check email uniqueness
        if (!empty($data['email']) && $this->userModel->exists('email', $data['email'], 'id', $excludeId)) {
            throw new \InvalidArgumentException('Email already exists');
        }

        return $data;
    }

    private function handleError(\Exception $e, string $defaultMessage): void
    {
        error_log($e->getMessage());
        $this->setFlashMessage('error', $defaultMessage);
    }

    private function setFlashMessage(string $type, string $message): void
    {
        // Implementar sistema de flash messages
        $_SESSION['flash'][$type] = $message;
    }
}