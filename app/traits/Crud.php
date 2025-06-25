<?php

namespace app\traits;

use core\Database;

use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use ClanCats\Hydrahon\Query\Sql\Insert;

trait Crud
{
    protected static $_h;
    
    public function __construct()
    {
        self::_checkH();
    }

    public static function _checkH()
    {
        if(self::$_h == null) {            

            try {
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

            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());                 
            }
        } 
    }

    protected function select()
    {
        self::_checkH();

        $args = func_get_args();

        if (func_num_args() == 1) {
            $table = self::$_h->table($args[0]);
            return $table->select(['*']);   
        } elseif (func_num_args() == 2) {
            $table = self::$_h->table($args[1]);
            return $table->select($args[0]);
        } else {
            throw new \Exception("Something wrong when reporting the arguments");            
        }
    }


    protected function update(String $table_name)
    {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->update(); 
    }


    protected function insert(array $data, String $table_name)
    {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->insert($data)->execute();
    }

    protected function delete(String $table_name)
    {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->delete();
    }
}