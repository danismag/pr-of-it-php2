<?php


namespace App\Models;


use App\Db;
use App\Model;

class MysqlTree extends Model
{
    public static $table = 'tree5';

    public function __construct()
    {
        $this->createTable();
    }

    protected function createTable()
    {
        $db = Db::instance();
        $db->execute(
            'CREATE TABLE IF NOT EXISTS ' .
            self::$table .
            ' (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(255),
                parent INT UNSIGNED,
                PRIMARY KEY (id)
              )
                CHARACTER SET UTF8,
                ENGINE MyISAM;'
        );

    }
}