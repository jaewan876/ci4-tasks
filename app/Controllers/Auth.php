<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends BaseController
{
    private $key;
    protected $userModel;

    public function __construct()
    {
        $this->key = getenv('JWT_SECRET_KEY'); // Replace with your secret key.
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('auth/login_form');
    }

    public function register()
    {
        return view('auth/register_form');
    }

    public function register_handler()
    {
        $validationRules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]'
            ],
            'email'    => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[4]'
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ],
        ];

        if (!$this->validate($validationRules)) {
            // Set flash data for errors and redirect back to the registration form
            return redirect()->back()->with('errors', $this->validator->listErrors())->withInput();
        }

        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->userModel->insert($data);

        // Set a success message and redirect to the login page
        return redirect()->to('/')->with('success', 'Registration successful! You can now log in.');
    }

    public function login_handler()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

         if (!$this->validate($validationRules)) {
            // Set flash data for errors and redirect back to the login form
            return redirect()->back()->with('errors', $this->validator->listErrors())->withInput();
        }

        $data = $this->request->getPost();

        $user = $this->userModel->where('username', $data['username'])->first();

        if ($user && password_verify($data['password'], $user['password'])) {
            // Store user information in the session
            session()->set('user', [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
            ]);

            // Redirect to the user dashboard
            return redirect()->to('tasks');
        }

        // Set a failure message and redirect back to the login form
        return redirect()->back()->with('error', 'Invalid username or password.')->withInput();
    }

    public function logout(){
        // Destroy the session
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/');
    }
}

