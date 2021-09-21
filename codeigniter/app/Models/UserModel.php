<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'accounts';
    protected $allowedFields    = [
        'username', 'email', 'password',
    ];
    protected $returnType       = 'App\Entities\User';
    protected $useTimestamps    = false;

    public function login($username, $password)
    {
        $user = new \App\Entities\User();
        $user->fill($this->asArray()->where(['username' => $username])->first());
        return $user;
    }

    public function getUsers($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        $user = new \App\Entities\User();
        $user->fill($this->asArray()->where(['id' => $id])->first());
        return $user;
    }
}