<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . 'classes/Session.php';
require_once ROOT_PATH . 'classes/Stacks.php';


require_once ROOT_PATH . 'config/Database.php';

class Project {
  private Session $session;
  private Database $db;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function deleteById(Int $project_id) {
    $sql = 'DELETE FROM projects WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $project_id
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

  public function updateProject(
    Int $prj_id,
    String $prj_title,
    String $prj_description,
    Bool $prj_corporative,
    String $prj_challenge,
    String $prj_thumbnail,
    String $prj_solution,
    Array $prj_stacks,
    Bool $prj_status
  ) {
    $sql = 'UPDATE projects SET prj_title = $1, prj_description = $2, prj_corporative = $3, prj_challenge = $4, prj_thumbnail = $5, prj_solution = $6, prj_status = $7 WHERE id = $8;';

    $result = pg_query_params($this->dbConnection, $sql, [
      $prj_title,
      $prj_description,
      $prj_corporative ? 't' : 'f',
      $prj_challenge,
      $prj_thumbnail,
      $prj_solution,
      $prj_status ? 't' : 'f',
      $prj_id
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $stacks = new Stacks();

      $stacksUpdated = $stacks->updateProjectStacks($prj_stacks, $prj_id);

      if ($stacksUpdated) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  
  public function createPoject(
    String $prj_title,
    String $prj_description,
    Bool $prj_corporative,
    String $prj_challenge,
    String $prj_thumbnail,
    String $prj_solution,
    Array $prj_stacks
  ) {
    $sql = 'INSERT INTO projects (prj_title, prj_description, prj_corporative, prj_challenge, prj_thumbnail, prj_solution) VALUES ($1, $2, $3, $4, $5, $6) RETURNING id;';

    $result = pg_query_params($this->dbConnection, $sql, [
      $prj_title,
      $prj_description,
      $prj_corporative ? 't' : 'f',
      $prj_challenge,
      $prj_thumbnail,
      $prj_solution
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $project = pg_fetch_assoc($result);

      $stacks = new Stacks();

      $stacksCreated = $stacks->createProjectStacks($prj_stacks, $project['id']);

      if ($stacksCreated) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function findById(Int $project_id) {
    $sql = '
      select
        p.id,
        p.prj_title,
        p.prj_description,
        p.prj_status,
        p.prj_challenge,
        p.prj_solution,
        p.prj_thumbnail,
        p.prj_corporative,
        s.id as stack_id,
        s.name as stack_name,
        s.icon as stack_icon
      from projects p
      left join project_stacks ps
        on ps.project_id = p.id
      left join stacks s
        on s.id = ps.stack_id
      where p.id = $1';

    $result = pg_query_params($this->dbConnection, $sql, [ $project_id ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    $db_result_array = pg_fetch_all($result);

    $projects = [];

    foreach ($db_result_array as $row) {

      $projectId = $row['id'];

      if (!isset($projects[$projectId])) {
        $projects[$projectId] = [
          "id" => $row['id'],
          "prj_title" => $row['prj_title'],
          "prj_description" => $row['prj_description'],
          "prj_thumbnail" => $row['prj_thumbnail'],
          "prj_challenge" => $row['prj_challenge'],
          "prj_solution" => $row['prj_solution'],
          "prj_status" => $row['prj_status'],
          "prj_corporative" => $row['prj_corporative'],
          "stacks" => []
        ];
      }

      if (!empty($row['stack_id'])) {
        $projects[$projectId]['stacks'][] = [
          "id" => $row['stack_id'],
          "name" => $row['stack_name'],
          "icon" => $row['stack_icon']
        ];
      }
    }

    return array_values($projects)[0];
  }

  public function listProjects(Bool $prj_status = true) {
    $status = $prj_status ? 'f' : 't';

    $sql = '
      select
        p.id,
        p.prj_title,
        p.prj_description,
        p.prj_thumbnail,
        s.name as stack_name,
        s.icon as stack_icon
      from projects p
      left join project_stacks ps
        on ps.project_id = p.id
      left join stacks s
        on s.id = ps.stack_id
      where p.prj_status = $1 order by p.id;';

    $result = pg_query_params($this->dbConnection, $sql, [ $status ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    $db_result_array = pg_fetch_all($result);

    $projects = [];

    foreach ($db_result_array as $row) {

      $id = $row['id'];

      if (!isset($projects[$id])) {
        $projects[$id] = [
          'id' => $row['id'],
          'prj_title' => $row['prj_title'],
          'prj_description' => $row['prj_description'],
          'prj_thumbnail' => $row['prj_thumbnail'],
          'stacks' => []
        ];
      }

      if ($row['stack_name']) {
        array_push(
          $projects[$id]['stacks'],
          [
            'stack_name' => $row['stack_name'],
            'stack_icon' => $row['stack_icon']
          ]
        );
      }
    }

    return array_values($projects); 
  }
}
