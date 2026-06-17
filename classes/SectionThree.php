<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . 'config/Database.php';
require_once ROOT_PATH . 'classes/Session.php';
require_once ROOT_PATH . 'classes/Stacks.php';

class SectionThree {
  private Database $db;
  private Session $session;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function createFormation(
    String $institution,
    String $course,
    String $description,
    String $situation,
    Bool $still_studying,
    String $start_date,
    String $final_date
  ) {
    if (empty($institution) || empty($course) || empty($description) || empty($situation)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'INSERT INTO section_three (institution, course, description, situation, still_studying, start_date, final_date) VALUES ($1, $2, $3, $4, $5, $6, $7)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $institution,
      $course,
      $description,
      $situation,
      $still_studying ? 't' : 'f',
      $start_date,
      $final_date
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Formação criada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    } else {
      $this->session->create('error','Erro ao criar a formação');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }
  
  public function updateFormation(
    Int $formation_id,
    String $institution,
    String $course,
    String $description,
    String $situation,
    Bool $still_studying,
    String $start_date,
    String $final_date
  ) {
    if (empty($institution) || empty($course) || empty($description) || empty($situation)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'UPDATE section_three  SET institution = $1, course = $2, description = $3, situation = $4, still_studying = $5, start_date = $6, final_date = $7 WHERE id = $8';

    $result = pg_query_params($this->dbConnection, $sql, [
      $institution,
      $course,
      $description,
      $situation,
      $still_studying ? 't' : 'f',
      $start_date,
      $final_date,
      $formation_id, 
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Formação atualizada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

  public function getFormations() {
    $sql = 'SELECT * FROM section_three ORDER BY start_date ASC';

    $result = pg_query($this->dbConnection, $sql);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    return pg_fetch_all($result) ?: [];
  }

  public function deleteById(Int $formation_id) {
    $sql = 'DELETE FROM section_three WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $formation_id
      ]
    );

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Formação deletada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    } else {
      $this->session->create('error','Erro ao deletar a formação');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }
}
