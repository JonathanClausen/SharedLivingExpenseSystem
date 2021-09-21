<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{

    public function index()
    {
        $session = session();

        $model = new UserModel();

        $data['title'] = "Users";
        $data['users'] = $model->getUsers();
        
        $data['email'] = $name = $session->username;


        echo view('templates/header', $data);
        echo view('users/overview', $data);
        echo view('templates/footer', $data);
    }

    public function view($id = null)
    {
        $model = new UserModel();

        $data['user'] = $model->getUsers($id);

        if (empty($data['user']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $user);
        }

        $data['title'] = "user";


        echo view('templates/header', $data);
        echo view('users/view', $data);
        echo view('templates/footer', $data);
    }
}