<?php

require_once __DIR__ . '/../config/Database.php';

class User {
  private Database $db;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();

    $this->dbConnection = $this->db->connect();
  }

  public function searchUser(String $user_name) {
    $sql = 'SELECT * FROM users WHERE user_name ILIKE $1 ORDER BY id ASC';

    $result = pg_query_params($this->dbConnection, $sql, [
      $user_name,
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    return pg_fetch_all($result) ?: [];
  }

  public function findAll() {
    $sql = 'SELECT * FROM users ORDER BY id ASC';

    $result = pg_query($this->dbConnection, $sql);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    return pg_fetch_all($result) ?: [];
  }

  public function create(
    String $user_name,
    String $user_email,
    String $user_birth_date,
    String $user_password,
    String $user_description,
    String $user_role
  ) {
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users (user_name, user_email, user_birth_date, user_password, user_description, user_role) VALUES ($1, $2, $3, $4, $5, $6)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $user_name,
      $user_email,
      $user_birth_date,
      $hashed_password,
      $user_description,
      $user_role
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      return true;
    } else {
      return false;
    }
  }
  
  public function update(
    Int $user_id,
    String $user_name,
    String $user_email,
    String $user_birth_date,
    String $user_description,
    String $user_role
  ) {
    $sql = 'UPDATE users SET user_name = $1, user_email = $2, user_birth_date = $3, user_description = $4, user_role = $5 WHERE id = $6';

    $result = pg_query_params($this->dbConnection, $sql, [
      $user_name,
      $user_email,
      $user_birth_date,
      $user_description,
      $user_role,
      $user_id
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findById(Int $id) {
    $sql = 'SELECT * FROM users WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $id
      ]
    );

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_num_rows($result) > 0) {
      $user = pg_fetch_assoc($result);

      return $user;
    } else {
      return null;
    }
  }
  
  public function findByEmail(String $email) {
    $sql = 'SELECT * FROM users WHERE user_email = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $email
      ]
    );

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_num_rows($result) > 0) {
      return pg_fetch_assoc($result);
    } else {
      return null;
    }
  }
  
  public function deleteById(Int $user_id) {
    $sql = 'DELETE FROM users WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $user_id
      ]
    );

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_num_rows($result) > 0) {
      return pg_fetch_assoc($result);
    } else {
      return null;
    }
  }
}