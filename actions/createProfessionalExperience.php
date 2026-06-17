<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionTwo.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionTwo();
$session = new Session();

if (isset($_POST['create_pro_exp'])) {
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

  $section_id = $_POST['section_id'];
  $company = trim($_POST['company']);
  $description = trim($_POST['description']);
  $since = $_POST['since'];
  $start_date = $_POST['start_date'];
  $final_date = $_POST['final_date'];

  $actual_job_post = false;

  if (isset($_POST["actual_job"])) {
    $actual_job_post = true;
  }

  $section->createProfessionalExperience(
    $section_id,
    $company,
    $description,
    $actual_job_post,
    $actual_job_post ? $since : $start_date,
    $actual_job_post ? $since : $final_date
  );
}
