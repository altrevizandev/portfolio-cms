<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Stacks.php';
require_once ROOT_PATH . '/classes/Session.php';

$stacks = new Stacks();
$session = new Session();

if (isset($_POST["create_stack"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/stacks/create.php');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/stacks/create.php');
      exit;
    }
  }

  $stack_name = trim($_POST["stack_name"]);
  $stack_icon = trim($_POST["stack_icon"]);

  $stacks->create(
    $stack_icon,
    $stack_name,
  );

  
}
