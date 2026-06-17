<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/SectionOne.php';
require_once ROOT_PATH . '/classes/Session.php';

$sectionOne = new SectionOne();
$session = new Session();

if (isset($_POST['update_section_one'])) {
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

  $section_id = trim($_POST['section_id']);
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $birth_date = $_POST['birth_date'];
  $position = trim($_POST['position']);
  $about_me = trim($_POST['about_me']);
  $studies = trim($_POST['studies']);
  $stacks = $_POST['stacks'];

  if (isset($_POST["so_one_change_img"]) && empty($_FILES['new_image']['name'])) {
    $session->create("error", "Informe uma imagem para a nova Thumbnail");
    header('Location: /views/admin/change-home.php');
    exit;
  }

  if (isset($_POST["so_one_change_img"]) && !empty($_FILES['new_image']['name'])) {
    $oldImage = $_POST['old_image'];

    $filename = $_FILES['new_image']['name'];

    $tmpName = $_FILES['new_image']['tmp_name'];

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

    $sectionOne->update(
      $section_id,
      $image,
      $name,
      $address,
      $birth_date,
      $position,
      $studies,
      $about_me,
      $stacks
    );
  } else {
    $old_image = $_POST['old_image'];

    $sectionOne->update(
      $section_id,
      $old_image,
      $name,
      $address,
      $birth_date,
      $position,
      $studies,
      $about_me,
      $stacks
    );
  }

  $session->create("success", "Projeto atualizado com sucesso");
  header('Location: /views/projects/details.php?project_id='.$_POST["prj_id"]);
  exit;
}