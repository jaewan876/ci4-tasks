<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index(): string
    {
        $pending = $this->taskModel->where([
                'status' => 'pending',
            ])
            ->orderBy('position', 'ASC')
            ->orderBy('updated_at', 'DESC')->findAll();

        $completed = $this->taskModel->where([
                'status' => 'completed',
            ])
            ->orderBy('position', 'ASC')
            ->orderBy('updated_at', 'DESC')->findAll();

        return view('index', [
            'title' => 'Tasks',
            'task_pending' =>  $pending,
            'task_completed' =>  $completed,
        ]);
    }
}
