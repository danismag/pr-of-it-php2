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

    public function save()
    {
        if (null === $this->id){
            return $this->insert();
        }
        return $this->update();
    }

    public function delete()
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::$table . '
        WHERE id=:id';
        return $db->execute($sql, [':id' => $this->id]);
    }

    protected function update(): bool
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

    protected function insert(): bool
    {
        $fields = [];
        $data = [];
        $keys = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            if (null == $value) {
                $data[':' . $key] = 'NULL';
            }
            $data[':' . $key] = $value;
            $keys[] = ':' . $key;
            $fields[] = $key;
        }
        $db = new Db();
        $sql = 'INSERT INTO ' . static::$table .
            ' (' .
            implode(', ', $fields) .
            ')' .
            'VALUES (' .
            implode(', ', $keys) .
            ')';
        if ($db->execute($sql, $data)){

            $this->id = $db->lastId();
            return true;
        }
        return false;
    }
    
}