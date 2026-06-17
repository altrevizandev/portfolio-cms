<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Projects.php';
require_once ROOT_PATH . '/classes/Session.php';

$project = new Project();
$session = new Session();

if (isset($_POST["delete_stack"])) {
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


  $project->deleteById($_POST["project_id"]);

  $session->create("success", "Projeto deletado com sucesso");
  header('Location: /views/projects');
  exit;
}
