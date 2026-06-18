<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Projects.php';
require_once ROOT_PATH . '/classes/Session.php';

$stacks = new Stacks();
$projects = new Project();
$session = new Session();

if (isset($_POST["create_project"])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/projects/create.php');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/projects/create.php');
      exit;
    }
  }

  $filename = $_FILES['prj_thumbnail']['name'];

  $tmpName = $_FILES['prj_thumbnail']['tmp_name'];

  $destination =
    ROOT_PATH .
    '/public/images/' .
    $filename;

  move_uploaded_file(
    $tmpName,
    $destination
  );

  $thumbnail = '/public/images/' . $filename;

  $prj_corporative = isset($_POST["prj_corporative"]) ? true : false;

  $prj_stacks = [];

  if (isset($_POST["prj_stacks"])) {
    $prj_stacks = $_POST["prj_stacks"];
  } else {
    $session->create('error', 'Informe pelo menos uma stack');
    header('Location: /views/projects/create.php');
    exit;
  }

  $projects->createPoject(
    trim($_POST["prj_title"]),
    trim($_POST["prj_description"]),
    $prj_corporative,
    trim($_POST["prj_challenge"]),
    $thumbnail,
    trim($_POST["prj_solution"]),
    $_POST["prj_stacks"],
  );

  $session->create("success", "Projeto criado com sucesso");
  header('Location: /views/projects');
  exit;
}