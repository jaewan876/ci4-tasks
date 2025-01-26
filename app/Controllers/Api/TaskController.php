<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class TaskController extends ResourceController
{
    public function index()
    {
        // return $this->response->setJSON(['status' => 'Ok']);

        return $this->respond(['status' => 'Ok']);
        
    }
}