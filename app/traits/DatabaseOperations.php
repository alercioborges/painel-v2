<?php

namespace app\traits;

use core\Connection;

use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use ClanCats\Hydrahon\Query\Sql\Insert;

trait DatabaseOperations
{
    protected static ?Builder $queryBuilder = null;

    public function __construct()
    {
        self::initQueryBuilder();
    }

    public static function initQueryBuilder(): void
    {
        if (self::$queryBuilder == null) {

            try {
                $connection = Connection::getInstance();

                self::$queryBuilder = new Builder('mysql', function ($query, $queryString, $queryParameters) use ($connection) {
                    $statement = $connection->prepare($queryString);
                    $statement->execute($queryParameters);

                    if ($query instanceof FetchableInterface) {
                        return $statement->fetchAll(\PDO::FETCH_ASSOC);
                    } elseif ($query instanceof Insert) {
                        return $connection->lastInsertId();
                    } else {
                        return $statement->rowCount();
                    }
                });
            } catch (\Exception $e) {
                throw new \RuntimeException($e->getMessage());
            }
        }
    }

    protected function select(mixed $columnsOrTable = ['*'], ?string $table = null)
    {
        self::initQueryBuilder();

        if (func_num_args() === 1 && is_string($columnsOrTable)) {
            $table = $columnsOrTable;
            $columns = ['*'];
        } elseif (func_num_args() === 2 && is_array($columnsOrTable) && is_string($table)) {
            $columns = $columnsOrTable;
        } elseif (func_num_args() === 0) {
            $table = self::getTableName();
            $columns = $columnsOrTable;
        } else {
            throw new \InvalidArgumentException("Argumentos inválidos parao método");
        }

        if (!$table || !is_string($table)) {
            throw new \InvalidArgumentException("O nome da tabela deve ser informado como string.");
        }

        return self::$queryBuilder->table($table)->select((array) $columns);
    }


    protected function update($table = null)
    {
        self::initQueryBuilder();
        $tableName = $table ?? $this->getTableName();

        return self::$queryBuilder->table($tableName)->update();
    }


    protected function insert(array $data, $table = null)
    {
        self::initQueryBuilder();

        if (!empty($data)) {
            throw new \InvalidArgumentException('Insert data cannot be empty');
        }

        $tableName = $table ?? $this->getTableName();

        return self::$queryBuilder->table($tableName)->insert($data)->execute();
    }

    protected function delete($table = null)
    {
        self::initQueryBuilder();

        $tableName = $table ?? $this->getTableName();

        return self::$queryBuilder->table($tableName)->delete();
    }


    private function getTableName(): string
    {
        if (!property_exists($this, 'table')) {
            throw new \RuntimeException('Table name not defined in model');
        }

        return $this->table;
    }
}
