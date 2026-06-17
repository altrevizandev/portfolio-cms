<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionOne.php';
require_once ROOT_PATH . '/classes/Session.php';

$sectionOne = new SectionOne();
$session = new Session();

if (isset($_POST['create_section_one'])) {
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
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $birth_date = $_POST['birth_date'];
  $position = trim($_POST['position']);
  $about_me = trim($_POST['about_me']);
  $studies = trim($_POST['studies']);
  $stacks = $_POST['stacks'];

  $sectionOne->create(
    $image,
    $name,
    $address,
    $birth_date,
    $position,
    $studies,
    $about_me,
    $stacks
  );
}