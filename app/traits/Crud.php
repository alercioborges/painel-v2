<?php

namespace app\traits;

use core\Database;

use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use ClanCats\Hydrahon\Query\Sql\Insert;

trait Crud{

    protected static $_h;
    
    public function __construct()
    {
        self::_checkH();
    }

    public static function _checkH()
    {
        if(self::$_h == null) {
            $connection = Database::getInstance();
            self::$_h = new Builder('mysql', function($query, $queryString, $queryParameters) use($connection)
            {
                $statement = $connection->prepare($queryString);
                $statement->execute($queryParameters);

                if ($query instanceof FetchableInterface)
                {
                    return $statement->fetchAll(\PDO::FETCH_ASSOC);
                }
                elseif($query instanceof Insert)
                {
                    return $connection->lastInsertId();
                }
                else 
                {
                    return $statement->rowCount();
                }   
            });
        }
    }

    protected function select(array $columns = [], String $table_name)
    {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->select($columns);        
    }


    protected function update(String $table_name)
    {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->update(); 
    }

    protected function selectCondition(array $fields = [], String $table_name, array $condicion)
    {
        return $this->select($fields, $table_name)->where($condicion[0], $condicion[1], $condicion[2]);
    }

    public function paginationCondition(array $fields = [], String $table_name, array $condicion, int $page, int $perPage)
    {
        $offset = ($page - 1) * $perPage;     
        return $this->selectCondition($fields, $table_name, $condicion)->limit($perPage)->offset($offset)->get();
    }
}