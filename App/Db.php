<?php

namespace App;

use App\Exceptions\DbException;
use App\Traits\TSingleton;

class Db
{
    use TSingleton;

    protected $dbh;

    protected function __construct()
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
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param $sql
     * @param array $data
     * @param \App\Model $class
     * @return mixed
     * @throws DbException
     */
    public function query($sql, $data = [], $class = null)
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);

        }  catch (\PDOException $e) {
            throw new DbException('Ошибка в запросе '. $sql . $e->getMessage());
        }

        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    /**
     * @param $sql
     * @param array $data
     * @param null $class
     * @return \Generator
     * @throws DbException
     */
    public function queryEach($sql, $data = [], $class = null)
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);

        }  catch (\PDOException $e) {
            throw new DbException('Ошибка в запросе '. $sql . $e->getMessage());
        }

        if (null !== $class) {

            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        }
        while ($obj = $sth->fetch()) {

            yield $obj;
        }
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     * @throws DbException
     */
    public function execute($sql, $params = []): bool
    {
        try {
            return $this->dbh->prepare($sql)->execute($params);

        } catch (\PDOException $e) {
            throw new DbException($e->getMessage());
        }
    }

    /**
     * @param $sql
     * @return \Generator
     * @throws \App\Exceptions\DbException
     */
    public function prepareExecute($sql)
    {
        try {

            $sth = $this->dbh->prepare($sql);

            while ('stop' !== yield) {

                yield $sth->execute(yield);
            }

        } catch (\PDOException $e) {
            throw new DbException($e->getMessage());
        }
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