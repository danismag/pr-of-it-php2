<?php

namespace App;

abstract class Model
{
    public $id;

    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::$table .' ORDER BY id';
        return $db->query($sql, [], static::class);
    }

    public static function countAll()
    {
        $db = new Db();
        $sql = 'SELECT COUNT(*) AS num FROM ' . static::$table;
        return (int)$db->query($sql, [], static::class)[0]->num;
    }

    /**
     * Возвращает объект из БД по id
     * @param int $id
     * @return object | null
     *
     */
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE id = :id';
        return $db->query($sql, [':id' => $id], static::class)[0] ?? null;
    }

    /**
     * Возвращает указанное кол-во последних объектов или хотя бы один
     * @param int $num
     * @return array | null
     */
    public static function findLast($num)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' ORDER BY id DESC';
        $res = [];
        $i = 0;
        foreach ($db->queryEach($sql, [], static::class) as $obj) {

            $res[] = $obj;
            if (++$i >= $num) {
                break;
            }
        }
        return $res ?: null;
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
    public function fill(array $data)
    {
        $errors = new MultiException;

        foreach ($data as $key => $value) {

            $validator = 'validate' . ucfirst($key);

            if (method_exists($this, $validator)) {

                if (false === $this->$validator($value)) {

                    $errors->add(new \Exception("Заполните поле $key"));
                    continue;
                }
            }
            if (property_exists(static::class, 'mustNotBeFilled') &&
                in_array($key, static::$mustNotBeFilled)) {
                continue;
            }

            $this->$key = $data[$key];
        }

        if (!$errors->isEmpty()) {
            throw $errors;
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

    /**
     * Валидация строки
     * @param string $str
     * @return bool
     */
    protected function validateString(string $str):bool
    {
        if (strlen(trim($str)) < 2) {
            return false;
        }
        return true;
    }

}