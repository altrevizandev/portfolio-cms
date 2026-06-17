<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Stacks.php';
require_once ROOT_PATH . '/classes/Session.php';

$stacks = new Stacks();
$session = new Session();

if (isset($_POST["delete_stack"])) {
  $stack_id = trim($_POST["stack_id"]);

  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/stacks/edit.php?stack_id='.$stack_id);
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/stacks/edit.php?stack_id='.$stack_id);
      exit;
    }
  }


  $stacks->deleteById($stack_id);

  $session->create("success", "Stack deletada com sucesso");
  header('Location: /views/stacks');
  exit;
}
