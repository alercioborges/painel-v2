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

    protected function select(array $fields = [], String $table_name) {
        self::_checkH();
        $table = self::$_h->table($table_name);
        return $table->select($fields);
    }

    public static function insert($fields = []) {
        self::_checkH();
        return self::$_h->insert($fields);
    }

    public static function update($table_name)
    {
       self::_checkH();
       $table = self::$_h->table($table_name);
       return $table->update();
   }

   public static function delete() {
    self::_checkH();
    return self::$_h->delete();
}

}