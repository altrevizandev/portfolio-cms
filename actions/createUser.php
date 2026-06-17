<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Auth.php';
require_once ROOT_PATH . '/classes/Session.php';

$auth = new Auth();
$session = new Session();

if (isset($_POST["create_user"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/users/create.php');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/users/create.php');
      exit;
    }
  }

  $user_name = trim($_POST["user_name"]);
  $user_email = trim($_POST["user_email"]);
  $user_birth_date = trim($_POST["user_birth_date"]);
  $user_password = trim($_POST["user_password"]);
  $user_description = trim($_POST["user_description"]);
  $user_role = trim($_POST["user_role"]);

  $auth->createAccount(
    $user_name,
    $user_email,
    $user_birth_date,
    $user_password,
    $user_description,
    $user_role
  );
}
