<?php

namespace Mvc\Controllers;

use Mvc\Models\StepModel;

class StepController
{
    private StepModel $stepModel;

    public function __construct()
    {
        $this-> stepModel = new StepModel();
    }

    public function create($taskId) 
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        $data = $this->stepModel->create($taskId);

        http_response_code(201);
        echo json_encode([
            'status' => 201,
            'data' => $data,
        ]);
    }

    public function read($id)
    {
        header('Content-Type: application/json');
        $data = $this->stepModel->readById($id);

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

    public function each()
    {
        header('Content-Type: application/json');
        $data = $this->stepModel->each();

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

    public function eachFromTask($taskId)
    {
        header('Content-Type: application/json');
        $data = $this->stepModel->eachFromTask($taskId);

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

    public function update($taskId, $stepId)
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        if (isset($userData['name'])) {
            $data = $this->stepModel->update($taskId, $stepId, $userData['name']);
        }

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

    public function delete($taskId, $stepId)
    {
        header('Content-Type: application/json');
        $this->stepModel->delete($taskId, $stepId);

        http_response_code(204);

    }
}