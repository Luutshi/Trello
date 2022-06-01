<?php

namespace Mvc\Controllers;

use Config\Controller;
use Mvc\Models\TaskModel;
use Mvc\Models\StepModel;

class PageController extends Controller
{
    private TaskModel $taskModel;
    private StepModel $stepModel;

    public function __construct()
    {
        $this-> taskModel = new TaskModel();
        $this-> stepModel = new StepModel();
        parent::__construct();
    }

    public function home() {
        $tasks = $this->taskModel->each();
        $steps = $this->stepModel->each();

        echo $this->twig->render('home.html.twig', [
            'tasks' => $tasks,
            'steps' => $steps
        ]);
    }
}