<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function index()
    {
        $model = new UserModel();

        $data['title'] = "Users";
        $data['users'] = $model->getUsers();

        echo view('templates/header', $data);
        echo view('users/overview', $data);
        echo view('templates/footer', $data);
    }

    public function view($id = null)
    {
        $model = new UserModel();

        $data['users'] = $model->getUsers($id);

        if (empty($data['users']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['users']['username'];

        echo view('templates/header', $data);
        echo view('users/view', $data);
        echo view('templates/footer', $data);
    }
}