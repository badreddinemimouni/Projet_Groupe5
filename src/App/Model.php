<?php

namespace Tp\Project\App;

use PDO;
use Tp\Project\Config\Config;

class Model extends PDO
{
    private static $instance = null;

    private function __construct()
    {
        try {
            parent::__construct(
                "mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
                Config::DBUSER,
                Config::DBPWD
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function readAll($entity)
    {
        $query = $this->query('select * from ' . $entity);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getById($entity, $id)
    {
        $query = $this->query('select * from ' . $entity . ' where id=' . $id);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity))[0];
    }

    public function getByAttribute($entity, $attribute, $value, $comp = '=')
    {
        $query = $this->query("SELECT * FROM $entity WHERE $attribute $comp '$value'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getAttributeByAttribute($entity, $attribute, $byAttribute, $value, $comp = '=')
    {
        $query = $this->query("SELECT $attribute FROM $entity WHERE $byAttribute $comp '$value'");
        return $query->fetchColumn();
    }

    public function getProjectByParticipateUserId($userId)
    {
        $query = $this->query("SELECT p.*
                                FROM project p
                                JOIN participate pa ON p.id = pa.id
                                WHERE pa.user_id = $userId");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst('project'));
    }

    public function save($entity, $datas): void
    {
        $sql = 'INSERT into ' . $entity . ' (';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $sql .= $key;
            if ($i < $count) {
                $sql = $sql . ',';
            }
            $i++;
        }
        $sql .= ') VALUES (';
        $i = 0;
        var_dump($datas);
        foreach ($datas as $data) {
            $preparedDatas[] = htmlspecialchars($data);
            $sql .= "?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . ')';
        var_dump($preparedDatas);
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    public function updateById($entity, $id, $datas): void
    {
        $sql = 'UPDATE ' . $entity . ' SET ';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $preparedDatas[] = htmlspecialchars($value);
            $sql .= $key . " = ?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . " WHERE id='$id'";
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    public function deleteById($entity, $id): void
    {
        $sql = "DELETE from $entity WHERE id = '$id'";
        $this->exec($sql);
    }
}
