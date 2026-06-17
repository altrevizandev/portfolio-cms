<?php

session_start();

class Session {
  public static function createAuth(String $key, Array $value)
  {
    $_SESSION[$key] = $value;
  }
  
  public static function create(String $key, String $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get(String $key): Session | null {
    return $_SESSION[$key] ?? null;
  }

  public static function forget(String $key): void {
    unset($_SESSION[$key]);
  }
  
  public static function killSession(): void {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
  }
}