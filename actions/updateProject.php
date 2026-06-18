<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Projects.php';
require_once ROOT_PATH . '/classes/Session.php';

$project = new Project();
$session = new Session();

if (isset($_POST["update_project"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/projects/edit.php?project_id='.$_POST['prj_id']);
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/projects/edit.php?project_id='.$_POST['prj_id']);
      exit;
    }
  }

  $prj_stacks = [];

  if (isset($_POST['prj_stacks'])) {
    $prj_stacks = $_POST['prj_stacks'];
  } else {
    $session->create("error", "Informe pelo menos uma stack");
    header('Location: /views/projects/edit.php?project_id='.$_POST["prj_id"]);
    exit;  
  }

  $corporative = false;

  if (isset($_POST["prj_corporative"])) {
    $corporative = true;
  }
  
  $prj_status = false;

  if (isset($_POST["prj_status"])) {
    $prj_status = true;
  }

  if (isset($_POST["changing_thumbnail"]) && empty($_FILES['new_thumbnail']['name'])) {
    $session->create("error", "Informe uma imagem para a nova Thumbnail");
    header('Location: /views/projects/edit.php?project_id='.$_POST["prj_id"]);
    exit;
  }

  if (isset($_POST["changing_thumbnail"]) && !empty($_FILES['new_thumbnail']['name'])) {
    $oldThumb = $_POST['prj_old_thumbnail'];

    $filename = $_FILES['new_thumbnail']['name'];

    $tmpName = $_FILES['new_thumbnail']['tmp_name'];

    $newDestination =
      ROOT_PATH .
      '/public/images/' .
      $filename;

    $oldDestination = ROOT_PATH . $oldThumb;

    if (file_exists($oldDestination)) {
      unlink($oldDestination);
    }

    move_uploaded_file(
      $tmpName,
      $newDestination
    );

    $thumbnail = '/public/images/' . $filename;

    $project->updateProject(
      trim($_POST["prj_id"]),
      trim($_POST["prj_title"]),
      trim($_POST["prj_description"]),
      $corporative,
      trim($_POST["prj_challenge"]),
      $thumbnail,
      trim($_POST["prj_solution"]),
      $_POST["prj_stacks"],
      $prj_status
    );
  } else {
    $thumbnail = $_POST['prj_old_thumbnail'];

    $project->updateProject(
      trim($_POST["prj_id"]),
      trim($_POST["prj_title"]),
      trim($_POST["prj_description"]),
      $corporative,
      trim($_POST["prj_challenge"]),
      $thumbnail,
      trim($_POST["prj_solution"]),
      $_POST["prj_stacks"],
      $prj_status
    );

    $session->create("success", "Projeto atualizado com sucesso");
    header('Location: /views/projects/details.php?project_id='.$_POST["prj_id"]);
    exit;
  }

  $session->create("success", "Projeto atualizado com sucesso");
  header('Location: /views/projects/details.php?project_id='.$_POST["prj_id"]);
  exit;
}