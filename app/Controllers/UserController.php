<?php

namespace App\Controllers;
use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    public function dashboard()
    {
        // $model = new UsersModel();
        // $data['users'] = $model->findAll();

        return view('dashboard');
    }

}
