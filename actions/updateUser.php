<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/User.php';
require_once ROOT_PATH . '/classes/Session.php';

$user = new User();
$session = new Session();

if (isset($_POST["update_user"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/users/edit.php?user_id='.$_POST['user_id']);
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/users/edit.php?user_id='.$_POST['user_id']);
      exit;
    }
  }

  $user_id = trim($_POST["user_id"]);
  $user_name = trim($_POST["user_name"]);
  $user_email = trim($_POST["user_email"]);
  $user_birth_date = trim($_POST["user_birth_date"]);
  $user_description = trim($_POST["user_description"]);
  $user_role = trim($_POST["user_role"]);

  $user->update(
    $user_id,
    $user_name,
    $user_email,
    $user_birth_date,
    $user_description,
    $user_role
  );

  $session->create("success", "Usuário atualizado com sucesso");
  header('Location: /views/users');
  exit;
}