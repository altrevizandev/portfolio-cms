<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/User.php';
require_once ROOT_PATH . '/classes/Session.php';

$user = new User();
$session = new Session();

if (isset($_POST["delete_user"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/users');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
    header('Location: /views/users');
    exit;
    }
  }

  $user_id = trim($_POST["user_id"]);

  $user->deleteById($user_id);

  $session->create("success", "Usuário deletado com sucesso");
  header('Location: /views/users');
  exit;
}
