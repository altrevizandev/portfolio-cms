<?php

require_once __DIR__ . '/../config/Constants.php';

class Result {
  private Database $db;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
  }

  public function createPojectResults(
    Int $prj_id,
    Array $prj_results
  ) {
    $projectResultCreated = true;

    foreach ($prj_results as $prj_result) {
      $sql = 'INSERT INTO projects_results (project_id, description) VALUES ($1, $2);';

      $result = pg_query_params($this->dbConnection, $sql, [
        $prj_id,
        $prj_result
      ]);

      if (!$result) {
        die(pg_last_error($this->dbConnection));
      }

      if (pg_affected_rows($result) > 0) {
        $projectResultCreated = true;
      } else {
        $projectResultCreated =  false;
        break;
      }
    }

    return $projectResultCreated;
  }
}
