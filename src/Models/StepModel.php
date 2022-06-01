<?php

namespace Mvc\Models;

use PDO;
use Config\Model;

class StepModel extends Model
{

    public function create($taskID)
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('INSERT INTO `tasks_steps` (`task_id`, `name`, `createdAt`) VALUES (:task_id, :name, :createdAt)');
        $statement->execute([
            'task_id' => $taskID,
            'name' => '',
            'createdAt' => $today->format('Y-m-d H:i:s'),
        ]);

        return $this->readById($this->pdo->lastInsertId());
    }

    public function readById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `tasks_steps` WHERE id = :id');
        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function each()
    {
        $statement = $this->pdo->prepare('SELECT * FROM `tasks_steps`');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eachFromTask($taskId)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `tasks_steps` WHERE `task_id` = :id');
        $statement->execute([
            'id' => $taskId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($taskId, $stepId, $name)
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('UPDATE `tasks_steps` SET `name` = :name, `updatedAt` = :updatedAt WHERE `id` = :step_id AND `task_id` = :task_id');
        $statement->execute([
            'task_id' => $taskId,
            'step_id' => $stepId,
            'name' => $name,
            'updatedAt' => $today->format('Y-m-d H:i:s'),
        ]);

        return $this->readById($stepId);
    }

    public function delete($taskId, $stepId)
    {
        $statement = $this->pdo->prepare('DELETE FROM `tasks_steps` WHERE `id` = :step_id AND `task_id` = :task_id');
        $statement->execute([
            'step_id' => $stepId,
            'task_id' => $taskId,
        ]);
    }
}