<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Contacts.php';
require_once ROOT_PATH . '/classes/Session.php';

$contacts = new Contacts();
$session = new Session();

if (isset($_POST['create_contact'])) {
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

  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $github = $_POST['github'];
  $linkedin = $_POST['linkedin'];

  $contacts->addContact(
    $phone,
    $email,
    $github,
    $linkedin
  );
}
