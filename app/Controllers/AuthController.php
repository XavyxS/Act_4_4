<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AuthController extends BaseController
{
  public function index()
  {
    if (isset($_COOKIE['remember_token'])) {
      $token = $_COOKIE['remember_token'];
      $model = new UsersModel();
      $user = $model->where('remember_token', $token)->first();
      if ($user) {
        $session = session();
        $session->set([
          'user_id' => $user['id'],
          'name' => $user['name'],
          'email' => $user['email'],
          'is_logged_in' => true
        ]);
        return redirect()->to('/dashboard'); // Redirige a /dashboard si la cookie existe
      }
    }
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

    // Verificar si el usuario ya existe
    $user = $model->where('email', $email)->first();
    if ($user) {
      return redirect()->back()->with('error', 'Usuario ya registrado en el sistema');
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Datos a insertar
    $data = [
      'name' => $name,
      'email' => $email,
      'password' => $hashedPassword,
      'last_login' => date('Y-m-d H:i:s')
    ];

    // Insertar el nuevo usuario
    if ($model->insert($data)) {
      $newUser = $model->where('email', $email)->first();

      $session = session();
      $session->set([
        'user_id' => $newUser['id'],
        'name' => $newUser['name'],
        'email' => $newUser['email'],
        'is_logged_in' => true
      ]);

      $token = bin2hex(random_bytes(16));
      setcookie('remember_token', $token, time() + (60 * 60 * 24 * 180), '/');

      $model->update($newUser['id'], [
        'last_login' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s'),
        'remember_token' => $token
      ]);

      return redirect()->to('/dashboard');
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

      $token = bin2hex(random_bytes(16));
      setcookie('remember_token', $token, time() + (60 * 60 * 24 * 180), '/');

      $model->update($user['id'], [
        'last_login' => date('Y-m-d H:i:s'),
        'remember_token' => $token
      ]);

      return redirect()->to('/dashboard');
    } else {
      return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();

    // Borra la cookie;
    setcookie('remember_token', '', time() - 3600, '/');
    return redirect()->to('/home');
  }
}
