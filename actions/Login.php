<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Auth.php';

if (isset($_POST["handle_login"])) {
  $user_email = trim($_POST["user_email"]);
  $user_password = trim($_POST["user_password"]);

  $auth = new Auth();

  $auth->login($user_email, $user_password);
}
