<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        $data['title'] = "Login";
        echo view('login/login', $data);

    }

    public function authenticate()
    {
        
        $session = session();

        $model = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($user = $model->login($username, $password)) {
            if ($user->password == $password){
                $ses_data = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/users');
            } else {
                echo "Wrong password";

            }
            
            
        } else {
            $data['error'] = 'Invalid Account';
            $this->load->view('demo/index', $data);
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        redirect('login');
    }
}