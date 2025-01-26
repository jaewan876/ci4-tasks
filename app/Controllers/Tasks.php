<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TaskModel;

class Tasks extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        $pending = $this->taskModel->where([
                'user_id' => session()->get('user.user_id'),
                'status' => 'pending',
            ])
            ->orderBy('position', 'ASC')
            ->orderBy('updated_at', 'DESC')->findAll();

        $completed = $this->taskModel->where([
                'user_id' => session()->get('user.user_id'),
                'status' => 'completed',
            ])
            ->orderBy('position', 'ASC')
            ->orderBy('updated_at', 'DESC')->findAll();
            
        return view('_panels/user/tasks/index', [
            'title' => 'Tasks',
            'tasks' => $pending,
            'task_completed' => $completed,
        ]);
    }

    public function create(){
        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'user_id' => session()->get('user.user_id'),
        ]);

        return redirect()->to('/tasks')->with('success', 'Task created successfully.');
    }

    public function store(){
        
    }

    public function edit($id = null){
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        // Check if the current user is the creator of the task
        if ($task['user_id'] != session()->get('user.user_id')) {
            return redirect()->to('/tasks')->with('error', 'You do not have permission to edit this task.');
        }

        return view('_panels/user/tasks/edit_form', [
            'title' => 'Tasks',
            'task' => $this->taskModel->find($id),
        ]);
    }

    public function update($id = null){
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        // Check if the current user is the creator of the task
        if ($task['user_id'] != session()->get('user.user_id')) {
            return redirect()->to('/tasks')->with('error', 'You do not have permission to edit this task.');
        }

        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
            'status' => 'required|in_list[pending,completed]',
            'position' => 'required|integer|greater_than_equal_to[0]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'position' => $this->request->getPost('position'),
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    public function delete($id = null){
        
    }
}
