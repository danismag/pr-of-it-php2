<?php


namespace App\Models;


use App\Db;
use App\Model;

/**
 * Class MysqlTree
 * @package App\Models
 * @property array $children
 * @property \App\Models\MysqlTreeLeaf $father
 */
class MysqlTreeLeaf extends Model
{
    const RECORD_NUMBER = 100;

    public static $table = 'tree5';
    protected static $db;

    public $name;
    public $parent;

    public static function findRootAll()
    {
        
    }

    public function __construct()
    {
        self::$db = Db::instance();
        $this->createTable();
    }

    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        if (method_exists(self::class, $method)) {

            return $this->$method();
        }
    }

    public function __isset($key)
    {
        return method_exists(self::class, 'get' . ucfirst($key));
    }

    public function getChildren()
    {
        return self::$db->query(
            'SELECT * FROM ' . self::$table . ' WHERE parent = :parent',
        [':parent' => $this->id],
        self::class);
    }

    public function getFather()
    {
        return self::$db->query(
            'SELECT * FROM ' . self::$table . ' WHERE id = :id',
            [':id' => $this->parent],
            self::class)[0];
    }

    protected function createTable()
    {
        self::$db->execute(
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

    protected function fillTable()
    {
        // Clear table
        self::$db->execute('TRUNCATE ' . self::$table);

        $sql = 'INSERT INTO ' . self::$table .
            '(name, parent) VALUES (:name, :parent)';

        /** @var \Generator $gen */
        $gen = self::$db->prepareExecute($sql);
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 1; $i <= self::RECORD_NUMBER; $i++) {

            $params['name'] =
                substr($chars, rand(0, 24), 1) .
                substr($chars, rand(0, 24), 1);
            $params['parent'] = rand(0, self::$db->lastId() ?? 0);
            $gen->send($params);
        }
        $gen->send('stop');

    }
}