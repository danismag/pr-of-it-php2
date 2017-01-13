<?php

namespace App;

abstract class Model
{

    public $id;

    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    public static function countAll()
    {
        $db = new Db();
        $sql = 'SELECT COUNT(*) AS num FROM ' . static::$table;
        return (int)$db->query($sql, [], static::class)[0]->num;
    }

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE id = :id';
        $res = $db->query($sql, [':id' => $id], static::class);
        return $res[0] ?? false;
    }

    /**
     * Возвращает указанное число последних значений
     * @param $num
     * @return object
     */
    public static function findLast($num)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE id > '.
            (static::countAll() > $num ? (static::countAll() - $num) : 0) .
            ' ORDER BY id DESC';
        return $db->query($sql, [], static::class);
    }

    public function update()
    {
        $sets = [];
        $data = [];
        foreach ($this as $key => $value) {
            $data[':' . $key] = $value;
            if ('id' == $key) {
                continue;
            }
            $sets[] = $key . '=:' . $key;
        }
        $db = new Db();
        $sql = 'UPDATE ' . static::$table . ' 
        SET ' . implode(',', $sets) . ' 
        WHERE id=:id';
        return $db->execute($sql, $data);
    }
}