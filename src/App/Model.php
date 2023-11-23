<?php

namespace Tp\Project\App;

use PDO;
use Tp\Project\Config\Config;

class Model extends PDO
{
    private static $instance = null;

    // Constructeur privé pour empêcher l'instanciation directe de la classe
    private function __construct()
    {
        try {
            // Initialisation de la connexion à la base de données en utilisant les paramètres de configuration
            parent::__construct(
                "mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
                Config::DBUSER,
                Config::DBPWD
            );
        } catch (\PDOException $e) {
            echo $e->getMessage(); // Affiche un message d'erreur en cas d'échec de connexion
        }
    }

    // Méthode statique pour obtenir une instance unique de la classe Model
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    // Méthode pour récupérer tous les enregistrements d'une table spécifique
    public function readAll($entity)
    {
        $query = $this->query('select * from ' . $entity);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    // Méthode pour récupérer un enregistrement par son ID dans une table spécifique
    public function getById($entity, $id)
    {
        $query = $this->query('select * from ' . $entity . ' where id=' . $id);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity))[0];
    }

    // Méthode pour récupérer des enregistrements en fonction d'un attribut spécifique dans une table
    public function getByAttribute($entity, $attribute, $value, $comp = '=')
    {
        $query = $this->query("SELECT * FROM $entity WHERE $attribute $comp '$value'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getOneByAttribute($entity, $attribute, $value, $comp = '=')
    {
        $query = $this->query("SELECT * FROM $entity WHERE $attribute $comp '$value'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity))[0];
    }

    // Méthode spécifique pour récupérer le label de priorité en fonction de son ID
    public function getPriorityLabel($id)
    {
        $query = $this->query('select value from priority where id_priority=' . $id);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst('priority'))[0];
    }

    // Méthode spécifique pour récupérer le label de statut en fonction de son ID
    public function getStatusLabel($id)
    {
        $query = $this->query('select value from status where id_status=' . $id);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst('status'))[0];
    }

    // Méthode pour récupérer un attribut spécifique en fonction d'un autre attribut dans une table
    public function getAttributeByAttribute($entity, $attribute, $byAttribute, $value, $comp = '=')
    {
        $query = $this->query("SELECT $attribute FROM $entity WHERE $byAttribute $comp '$value'");
        return $query->fetchColumn();
    }
    // Méthode
    public function getParticipantsByproject($projectId)
    {
        $query = $this->query("SELECT *
                                    FROM users u
                                    JOIN participate pa ON u.user_id = pa.user_id
                                    WHERE pa.id = $projectId");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst('users'));
    }

    // Méthode pour récupérer les projets associés à un utilisateur via la table de liaison 'participate'
    public function getProjectByParticipateUserId($userId)
    {
        $query = $this->query("SELECT p.*
                                FROM project p
                                JOIN participate pa ON p.id = pa.id
                                WHERE pa.user_id = $userId");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst('project'));
    }

    // Insére de nouvelles données dans une table de la base de données
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

    // Met à jour des données dans une table spécifique en fonction de l'ID fourni
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

    public function updateByAttribute($entity, $attribute, $id, $datas): void
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
        $sql = $sql . " WHERE " . $attribute . " ='$id'";
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    // Supprime des données d'une table spécifique en fonction de l'ID fourni
    public function deleteById($entity, $id): void
    {
        $sql = "DELETE from $entity WHERE id = '$id'";
        $this->exec($sql);
    }
}
