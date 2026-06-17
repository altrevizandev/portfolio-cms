<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Contacts.php';
require_once ROOT_PATH . '/classes/Session.php';

$contacts = new Contacts();
$session = new Session();

if (isset($_POST['update_contact'])) {
  if (!isset($_SESSION['user'])) {
    $session->create('message', 'Você não é um administrador!');
    header('Location: /views/contact');
    exit;
  } else {
    if ($_SESSION['user']['user_role'] != 'admin') {
      $session->create('message', 'Você não é um administrador!');
      header('Location: /views/contact');
      exit;
    }
  }

  $contacts->update(
    $_POST['contact_id'],
    $_POST['phone'],
    trim($_POST['email']),
    str_contains(trim($_POST['github']), 'https://') ? trim($_POST['github']) : 'https://'.trim($_POST['github']),
    str_contains(trim($_POST['linkedin']), 'https://') ? trim($_POST['linkedin']) : 'https://'.trim($_POST['linkedin']),
  );
}