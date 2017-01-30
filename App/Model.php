<?php

namespace App;

use App\Exceptions\NotFoundException;

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
        if (empty($res)) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        return $res[0];
    }

    /**
     * Возвращает указанное число последних значений
     * @param int $num
     * @return array
     */
    public static function findLast($num)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE id > '.
            (static::countAll() > $num ? (static::countAll() - $num) : 0) .
            ' ORDER BY id DESC';
        return $db->query($sql, [], static::class);
    }

    /**
     * Проверяет, является ли объект новым (занесенным в БД)
     * @return bool
     */
    public function isNew():bool
    {
        if (null === $this->id){
            return true;
        }
        return false;
    }

    /**
     * Сохраняет или перезаписывает объект
     * @return bool
     */
    public function save(): bool
    {
        if ($this->isNew()){
            return $this->insert();
        }
        return $this->update();
    }

    /**
     * Удаление объекта
     * @return bool
     */
    public function delete(): bool
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::$table . '
        WHERE id=:id';
        return $db->execute($sql, [':id' => $this->id]);
    }

    /**
     * Заполняет поля объекта данными из массива
     * @param array $data
     * @throws MultiException
     */
    public function fill($data = [])
    {
        $errors = new MultiException;
        if (!empty($data)) {
            foreach ($this as $key => $value) {
                if ('id' !== $key && key_exists($key, $data)) {
                    if (empty($data[$key])) {

                        $errors->add(new \Exception("Заполните поле $key"));
                    }
                }
            }
        }

        if (!$errors->isEmpty()) {
            throw $errors;
        }

        foreach ($this as $key => $value) {
            if ('id' !== $key && key_exists($key, $data)) {
                $this->$key = $data[$key];
            }
        }
    }

    /**
     * Обновление объекта
     * @return bool
     */
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

    /**
     * Вставка нового объекта
     * @return bool
     */
    protected function insert(): bool
    {
        $fields = [];
        $data = [];
        $keys = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            /*if (null == $value) {
                $data[':' . $key] = 'NULL';
            }*/
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