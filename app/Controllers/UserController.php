<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
  public function dashboard()
  {
    $model = new UsersModel();
    $data['users'] = $model->findAll();

    return view('dashboard', $data);
  }

  public function delete($id)
  {
    $model = new UsersModel();
    $model->delete($id);

    return redirect()->to('/dashboard');
  }

  public function edit($id)
  {
    $model = new UsersModel();
    $data['user'] = $model->find($id);

    if (!$data['user']) {
      throw PageNotFoundException::forPageNotFound();
    }

    return view('/registroForm', $data);
  }

  public function update($id)
  {
    $password = $this->request->getPost('password');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $model = new UsersModel();

    $model->update($id, [
      'name' => $this->request->getPost('name'),
      'email' => $this->request->getPost('email'),
      'password' => $hashedPassword
    ]);

    return redirect()->to('/dashboard');
  }
}
