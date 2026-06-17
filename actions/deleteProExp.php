<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionTwo.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionTwo();
$session = new Session();

if (isset($_POST["delete_pro_exp"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/projects/details.php?project_id='.$_POST["project_id"]);
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/projects/details.php?project_id='.$_POST["project_id"]);
      exit;
    }
  }

  $section->deleteById($_POST["exp_id"]);
}