<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionThree.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionThree();
$session = new Session();

if (isset($_POST['update-formation'])) {
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

  $still_studying = isset($_POST['still_studying']) ? true : false;

  $formation_id = $_POST['formation_id'];
  $institution = trim($_POST['institution']);
  $course = trim($_POST['course']);
  $description = trim($_POST['description']);
  $situation = $_POST['situation'];
  $since = $_POST['since'];
  $start_date = $_POST['start_date'];
  $final_date = $_POST['final_date'];

  $section->updateFormation(
    $formation_id,
    $institution,
    $course,
    $description,
    $situation,
    $still_studying,
    $still_studying ? $since : $start_date,
    $still_studying ? $since : $final_date,
  );
}
