<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionThree.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionThree();
$session = new Session();

if (isset($_POST['delete-formation'])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/admin/change-home.php');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

  $formation_id = $_POST['formation_id'];

  $section->deleteById(
    $formation_id
  );
}
