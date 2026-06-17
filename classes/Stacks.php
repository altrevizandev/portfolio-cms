<?php

require_once __DIR__ . '/../config/Constants.php';

require_once __DIR__ . '/../config/Database.php';

require_once ROOT_PATH . '../classes/Session.php';

class Stacks {
  private Database $db;
  private Session $session;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->session = new Session();
    $this->dbConnection = $this->db->connect();
  }

  public function deleteById(Int $stack_id) {
    $sql = 'DELETE FROM stacks WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $stack_id
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

  public function update(
    Int $stack_id,
    String $stack_name,
    String $stack_icon,
  ) {
    $sql = 'UPDATE stacks SET name = $1, icon = $2 WHERE id = $3';

    $result = pg_query_params($this->dbConnection, $sql, [
      $stack_name,
      $stack_icon,
      $stack_id,
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
    $sql = 'SELECT * FROM stacks WHERE id = $1';

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

  public function listStacks() {
    $sql = 'SELECT * FROM stacks ORDER BY name ASC';

    $result = pg_query($this->dbConnection, $sql);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    return pg_fetch_all($result) ?: [];
  }

  public function create(
    String $stack_icon,
    String $stack_name
  ) {
    $sql = 'INSERT INTO stacks (icon, name) VALUES ($1, $2)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $stack_icon,
      $stack_name
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create("success", "Stack criada com sucesso");
      header('Location: /views/stacks/create.php');
      exit;
    } else {
      return false;
    }
  }
  
  public function createProjectStacks(
    Array $stacks,
    Int $project_id
  ) {
    $created = true;

    foreach ($stacks as $stack) {
      $sql = 'INSERT INTO project_stacks (project_id, stack_id) VALUES ($1, $2)';

      $result = pg_query_params(
        $this->dbConnection,
        $sql,
        [
          $project_id,
          $stack
        ]
      );

      if (!$result) {
        $created = false;
        die(pg_last_error($this->dbConnection));
      }
    }

    return $created;
  }
  
  public function createSectionStacks(
    Array $stacks,
    Int $section_id
  ) {
    $created = true;

    foreach ($stacks as $stack) {
      $sql = 'INSERT INTO section_stacks (section_id, stack_id) VALUES ($1, $2)';

      $result = pg_query_params(
        $this->dbConnection,
        $sql,
        [
          $section_id,
          $stack
        ]
      );

      if (!$result) {
        $created = false;
        die(pg_last_error($this->dbConnection));
      }
    }

    return $created;
  }
  
  public function updateSectionStacks(
    Array $stacks,
    Int $section_id
  ) {
    $delete_sql = 'DELETE FROM section_stacks WHERE section_id = $1';

    $result_delete_sql = pg_query_params(
      $this->dbConnection,
      $delete_sql,
      [
        $section_id,
      ]
    );

    if (!$result_delete_sql) {
      die(pg_last_error($this->dbConnection));
    }

    return $this->createSectionStacks($stacks, $section_id);
  }
  
  public function updateProjectStacks(
    Array $stacks,
    Int $project_id
  ) {
    $delete_sql = 'DELETE FROM project_stacks WHERE project_id = $1';

    $result_delete_sql = pg_query_params(
      $this->dbConnection,
      $delete_sql,
      [
        $project_id,
      ]
    );

    if (!$result_delete_sql) {
      die(pg_last_error($this->dbConnection));
    }

    return $this->createProjectStacks($stacks, $project_id);
  }
}
