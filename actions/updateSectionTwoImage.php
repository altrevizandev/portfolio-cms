<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionTwo.php';
require_once ROOT_PATH . '/classes/Session.php';

$section = new SectionTwo();
$session = new Session();

if (isset($_POST['update_section_two'])) {
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

  $oldImage = $_POST['old_image'];
  $section_id = $_POST['section_id'];

  if (isset($_POST['st_change_img']) && !empty($_FILES['image']['name'])) {
    $filename = $_FILES['image']['name'];

    $tmpName = $_FILES['image']['tmp_name'];

    $newDestination =
      ROOT_PATH .
      '/public/images/' .
      $filename;

    $oldDestination = ROOT_PATH . $oldImage;

    if (file_exists($oldDestination)) {
      unlink($oldDestination);
    }

    move_uploaded_file(
      $tmpName,
      $newDestination
    );

    $image = '/public/images/' . $filename;

    $section->updateSectionImage(
      $section_id,
      $image
    );
  } else {
    $section->updateSectionImage(
      $section_id,
      $oldImage
    );
  }
}