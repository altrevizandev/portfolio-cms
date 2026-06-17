<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionTwo.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionTwo();
$session = new Session();

if (isset($_POST['create_section_two'])) {
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

  $filename = $_FILES['image']['name'];

  $tmpName = $_FILES['image']['tmp_name'];

  $destination =
    ROOT_PATH .
    '/public/images/' .
    $filename;

  move_uploaded_file(
    $tmpName,
    $destination
  );

  $image = '/public/images/' . $filename;

  $section->createSectionTwo(
    $image,
  );
}