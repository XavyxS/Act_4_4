<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AuthController extends BaseController
{
  public function index()
  {
    return view('welcome');
  }

  public function loginForm()
  {
    return view('loginForm');
  }

  public function registroForm()
  {
    return view('registroForm');
  }

  public function registro()
  {
    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    if (empty($email) || empty($password) || empty($name)) {
      return redirect()->back()->with('error', 'El nombre, correo y la contraseña son requeridos.');
    }

    $model = new UsersModel();

    $user = $model->where('email', $email)->first();

    if ($user) {
      return redirect()->back()->with('error', 'Usuario ya registrado en el sistema');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $data = [
      'name' => $name,
      'email' => $email,
      'password' => $hashedPassword,
      // 'created_at' => date('Y-m-d H:i:s'),
      'last_login' => date('Y-m-d H:i:s')
    ];

    if ($model->insert($data)) {
      return redirect()->to('/dashboard')->with('message', 'Usuario creado con éxito.');
    } else {
      return redirect()->back()->with('error', 'Hubo un error al registrar el usuario.');
    }
  }

  public function login()
  {
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    if (empty($email) || empty($password)) {
      return redirect()->back()->with('error', 'El correo y la contraseña son requeridos.');
    }

    $model = new UsersModel();

    $user = $model->where('email', $email)->first();

    if (!$user) {
      return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }

    if (password_verify($password, $user['password'])) {
      $session = session();
      $session->set([
        'user_id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'is_logged_in' => true
      ]);

      $model->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

      return redirect()->to('/dashboard');
    } else {
      return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }
  }
}
