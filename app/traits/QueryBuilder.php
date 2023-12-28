<?php

namespace app\traits;

use core\Database;

use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;

trait QueryBuilder{

    protected static $_h;
    
    public function __construct() {
        self::_checkH();
    }

    public static function _checkH() {
        if(self::$_h == null) {
            $connection = Database::getInstance();
            self::$_h = new Builder('mysql', function($query, $queryString, $queryParameters) use($connection) {
                $statement = $connection->prepare($queryString);
                $statement->execute($queryParameters);

                if ($query instanceof FetchableInterface)
                {
                    return $statement->fetchAll(\PDO::FETCH_ASSOC);
                }
            });
        }
        
        self::$_h = self::$_h->table( self::getTableName() );
    }

    public static function getTableName($table) {
        return $table;
    }

    public static function select($fields = []) {
        self::_checkH();
        return self::$_h->select($fields);
    }

    public static function insert($fields = []) {
        self::_checkH();
        return self::$_h->insert($fields);
    }

    public static function updateData($fields = []) {
        self::_checkH();
        return self::$_h->update($fields);
    }

    public static function deleteData() {
        self::_checkH();
        return self::$_h->delete();
    }

}