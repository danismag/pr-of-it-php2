<?php

namespace App;

class Db
{

    protected $dbh;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=php2';
        $user = 'danis';
        $password = '';
        $this->dbh = new \PDO($dsn, $user, $password);
        $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
//        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function query($sql, $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false === $res) {
            die('DB error in ' . $sql);
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function execute($sql, $params=[])
    {
        return $this->dbh->prepare($sql)->execute($params);

    }

    /*public function test()
    {
        return $this->dbh->prepare(
            'INSERT INTO news (title, text) VALUES (:head, :str)'
        )
            ->execute([
                ':head' => 'Кофе не растет',
                ':str' => 'В станицах Краснодарского края больше не смогут выращивать кофейные деревья. Все существующие сорта выродились'
            ]);
    }*/

}