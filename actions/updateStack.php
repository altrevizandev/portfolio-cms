<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Stacks.php';
require_once ROOT_PATH . '/classes/Session.php';

$stacks = new Stacks();
$session = new Session();

if (isset($_POST["update_stack"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/stacks/edit.php?stack_id='.$_POST['stack_id']);
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/stacks/edit.php?stack_id='.$_POST['stack_id']);
      exit;
    }
  }

  $stack_id = trim($_POST["stack_id"]);
  $stack_name = trim($_POST["stack_name"]);
  $stack_icon = trim($_POST["stack_icon"]);

  $stacks->update(
    $stack_id,
    $stack_name,
    $stack_icon,
  );

  $session->create("success", "Stack atualizada com sucesso");
  header('Location: /views/stacks');
  exit;
}