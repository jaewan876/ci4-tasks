<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = $this->userModel->find(session()->get("user.user_id"));

        return view('_panels/user/profile/index', [
            'title' => 'Profile',
            'user' => $user,
        ]);
    }

    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/profile')->with('errors', 'User not found.');
        }

        $data = $rules = array();

        // Check if 'username' field is present in the request
        if ($this->request->getPost('username') !== null) {
            $data['username'] = $this->request->getPost('username');
            $rules['username'] = [
                'label' => 'Username',
                'rules' => "required|min_length[3]|max_length[20]|is_unique[users.username,id,".$id."]",
            ];
        }

        // Check if 'email' field is present in the request
        if ($this->request->getPost('email') !== null) {
            $data['email'] = $this->request->getPost('email');
            $rules['email'] = [
                'label' => 'Email',
                'rules' => "required|valid_email|is_unique[users.email,id,".$id."]",
            ];
        }

        // Check if 'password' field is present in the request
        if ($this->request->getPost('password') !== null) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
            $rules['password'] = [
                'label' => 'Password',
                'rules' => 'required|min_length[4]',
            ];
        }

        if ($this->request->getPost('password_confirm') !== null) {
            $rules['password_confirm'] = [
                'label' => 'Password Confirm',
                'rules' => 'required|matches[password]',
            ];
        }

        if ($this->request->getPost('fullname') !== null) {
            $data['fullname'] = $this->request->getPost('fullname');
            $rules['fullname'] = [
                'label' => 'Fullname',
                'rules' => 'permit_empty|min_length[3]|max_length[50]',
            ];
        }

        // Check if 'email' field is present in the request
        if ($this->request->getPost('bio') !== null) {
            $data['bio'] = $this->request->getPost('bio');
            $rules['bio'] = [
                'label' => 'Bio',
                'rules' => 'permit_empty|max_length[1000]',
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }
}
