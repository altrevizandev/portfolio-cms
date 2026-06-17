<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . 'classes/User.php';
require_once ROOT_PATH . 'classes/Session.php';

class Auth {
  public User $users;
  public Session $session;

  public function __construct() {
    $this->users = new User();
    $this->session = new Session();
  }

  public function login(String $email, String $password): void {
    if (empty($email) || empty($password)) {
      $this->session->create("message", "Preencha todos os campos");
      
      header('Location: /views/login');
      exit;
    }

    $user = $this->users->findByEmail($email);

    if (!$user) {
      $this->session->create("error", "Email ou senha invalidos");
      
      header('Location: /views/login');
      exit;
    }

    if (!password_verify($password, $user['user_password'])) {
      $this->session->create("error", "Email ou senha invalidos");
      header('Location: /views/login');
      exit;
    }

    $this->session->createAuth("user", $user);

    header('Location: /');
    exit;
  }

  public function createAccount(
    String $user_name,
    String $user_email,
    String $user_birth_date,
    String $user_password,
    String $user_description,
    String $user_role
  ) {
    if (empty($user_name) || empty($user_email) || empty($user_birth_date) || empty($user_password) || empty($user_role) || empty($user_description)) {
      $this->session->create("message", "Preencha todos os campos");
      
      header('Location: /views/users/create.php');
      exit;
    }

    $existsAccountByEmail = $this->users->findByEmail($user_email);

    if ($existsAccountByEmail) {
      $this->session->create("error", "Já existe um conta cadastrada com esse e-mail");
      header('Location: /views/users/create.php');
      exit;
    }

    $this->users->create(
      $user_name,
      $user_email,
      $user_birth_date,
      $user_password,
      $user_description,
      $user_role
    );

    $this->session->create("success", "Usuário criado com sucesso");
    header('Location: /views/users');
    exit;
  }

  public function logout() {
    Session::killSession();
  }

  public function protectPage() {
    $hasAuth = $this->session->get("user");

    if (!$hasAuth) {
      header('Location: ../index.php');
      exit;
    }
  }

  public function isAuth() {
    $hasAuth = $this->session->get("user");

    return $hasAuth ? true : false;
  }
}
