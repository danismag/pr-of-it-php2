<?php

namespace App;

class Db
{

    protected $dbh;

    public function __construct()
    {
        $config = Config::instance();
        $dsn = 'mysql:host=' .
            $config->data['db']['host'] .
            ';dbname=' .
            $config->data['db']['dbname'];
        $this->dbh = new \PDO($dsn,
            $config->data['db']['user'],
            $config->data['db']['password']
        );
        $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    /**
     * @param $sql
     * @param array $data
     * @param null $class
     * @return mixed
     */
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

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, $params = []): bool
    {
        return $this->dbh->prepare($sql)->execute($params);
    }

    public function lastId(): int
    {
        return $this->dbh->lastInsertId();
    }

}