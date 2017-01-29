<?php

namespace App;

use App\Exceptions\DbException;

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
        try {
            $this->dbh = new \PDO($dsn,
                $config->data['db']['user'],
                $config->data['db']['password']
            );
        } catch (\PDOException $e) {

            throw new DbException('Сообщение с базой данных не установлено: ' . $e->getMessage());
        }

        $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
//        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
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
        if (!$res) {
            throw new DbException('Ошибка в запросе '. $sql);
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
        try {
            return $this->dbh->lastInsertId();

        } catch (\PDOException $e) {

            throw new DbException($e->getMessage());
        }
    }

}