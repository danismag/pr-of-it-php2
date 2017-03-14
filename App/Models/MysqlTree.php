<?php


namespace App\Models;


use App\Db;
use App\Model;

class MysqlTree extends Model
{
    const RECORD_NUMBER = 100;

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

        if (0 == self::countAll()) {

            $sql = 'INSERT INTO ' . self::$table .
                '(name, parent) VALUES (:name, :parent)';
            $gen = $db->prepareExecute($sql);
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            for ($i = 1; $i <= self::RECORD_NUMBER; $i++) {

                $params['name'] =
                    substr($chars, rand(0, 24), 1) .
                    substr($chars, rand(0, 24), 1);
                $params['parent'] = rand(0, $db->lastId() ?? 0);
                $gen->send($params);
            }
            $gen->send('stop');
        }
    }
}