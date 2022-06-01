<?php

namespace Mvc\Models;

use PDO;
use Config\Model;

class TaskModel extends Model
{
    public function create()
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('INSERT INTO `tasks` (`name`, `createdAt`) VALUES (:name, :createdAt)');
        $statement->execute([
            'name' => '',
            'createdAt' => $today->format('Y-m-d H:i:s'),
        ]);

        return $this->readById($this->pdo->lastInsertId());
    }

    public function readById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `tasks` WHERE id = :id');
        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function each()
    {
        $statement = $this->pdo->prepare('SELECT * FROM `tasks`');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateById($id, $name)
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('UPDATE `tasks` SET `name` = :name, `updatedAt` = :updatedAt WHERE id = :id');
        $statement->execute([
            'id' => $id,
            'name' => $name,
            'updatedAt' => $today->format('Y-m-d H:i:s'),
        ]);

        return $this->readById($id);
    }

    public function deleteById($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM `tasks` WHERE id = :id');
        $statement->execute([
            'id' => $id,
        ]);
    }
}