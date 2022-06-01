<?php

namespace Mvc\Controllers;

use Mvc\Models\TaskModel;

class TaskController
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this-> taskModel = new TaskModel();
    }

    public function create() {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        $data = $this->taskModel->create();

        http_response_code(201);
        echo json_encode([
            'status' => 201,
            'data' => $data,
        ]);
    }

    public function each()
    {
        header('Content-Type: application/json');
        $data = $this->taskModel->each();

        if ($data) {
            echo json_encode([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 404,
            ]);
        }
    }

    public function readById($id)
    {
        header('Content-Type: application/json');
        $data = $this->taskModel->readById($id);

        if ($data) {
            http_response_code(200);
            echo json_encode([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 404,
            ]);
        }
    }

    public function update($id)
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        $data = $this->taskModel->updateById($id, $userData['name']);

        if ($data) {
            echo json_encode([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 400,
            ]);
        }
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        $this->taskModel->deleteById($id);

        http_response_code(204);

    }

    public function createStep($id) 
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        if (isset($userData['name'])) {
            $data = $this->taskModel->create($id, $userData['name']);
        }

        http_response_code(201);
        echo json_encode([
            'status' => 201,
            'data' => $data,
        ]);
    }

    public function readAllSteps($id)
    {
        header('Content-Type: application/json');
        $data = $this->taskModel->each($id);

        if ($data) {
            echo json_encode([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 404,
            ]);
        }
    }
}