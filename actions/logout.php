<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Auth.php';

if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header('Location: /');
  exit;
}