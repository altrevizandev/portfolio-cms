<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/config/Database.php';
require_once ROOT_PATH . '/classes/Session.php';
require_once ROOT_PATH . '/classes/Stacks.php';

class SectionTwo {
  private Database $db;
  private Session $session;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function deleteById(Int $exp_id) {
    $sql = 'DELETE FROM section_two_experiences WHERE id = $1';

    $result = pg_query_params(
      $this->dbConnection,
      $sql,
      [
        $exp_id
      ]
    );

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create("success", "Experiencia profissional deletada com sucesso");
      header('Location: /views/admin/change-home.php');
      exit;
    } else {
      $this->session->create("error", "Erro ao deletar experiencia profissional");
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

  public function getSectionTwoData() {
    $sql_section_two = 'SELECT * FROM section_two';
    $sql_section_two_experiences = 'SELECT * FROM section_two_experiences ORDER BY start_date DESC;';

    $result_section_two = pg_query($this->dbConnection, $sql_section_two);
    
    if (!$result_section_two) {
      die(pg_last_error($this->dbConnection));
    }
    
    $result_section_two_experiences = pg_query($this->dbConnection, $sql_section_two_experiences);
    
    if (!$result_section_two_experiences) {
      die(pg_last_error($this->dbConnection));
    }

    $section_data = [
      "section_id" => 0,
      "image" => "",
      "experiences" => []
    ];

    $db_result_array_section_two = pg_fetch_all($result_section_two);
    $db_result_array_section_two_experiences = pg_fetch_all($result_section_two_experiences);

    foreach ($db_result_array_section_two_experiences as $row) {
      array_push($section_data['experiences'], [
        "id" => $row['id'],               
        "company" => $row['company'],               
        "description" => $row['description'],               
        "actual_job" => $row['actual_job'],               
        "start_date" => $row['start_date'],               
        "final_date" => $row['final_date']               
      ]);
    }

    $section_data['image'] = $db_result_array_section_two[0]['image'];
    $section_data['section_id'] = $db_result_array_section_two[0]['id'];

    return $section_data;
  }

  public function createSectionTwo(
    String $image,
  ) {
    if (empty($image)) {
      $this->session->create('error', 'Preencha o campo imagem os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'INSERT INTO section_two (image) VALUES ($1)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $image,
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Seção 2 criada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    } else {
      $this->session->create('error','Erro ao criar a seção 2');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }
  
  public function createProfessionalExperience(
    Int $section_id,
    String $company,
    String $description,
    Bool $actual_job,
    String $start_date,
    String $final_date
  ) {
    if (empty($company) || empty($description)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    if (!$actual_job) {
      if (empty($start_date) || empty($final_date)) {
        $this->session->create('error', 'Preencha os campos "De" e "Ate"');
        header('Location: /views/admin/change-home.php');
        exit;
      }
    }

    $sql = 'INSERT INTO section_two_experiences (company, description, actual_job, start_date, final_date, section_id) VALUES ($1, $2, $3, $4, $5, $6)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $company,
      $description,
      $actual_job ? 't' : 'f',
      $start_date,
      $final_date,
      $section_id
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Experiencia profissional criada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    } else {
      $this->session->create('error','Erro ao criar a experiencia profissional');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

  public function updateSectionImage(
    String $section_id,
    String $image
  ) {
    if (empty($image)) {
      $this->session->create('error', 'Preencha o campo imagem');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'UPDATE section_two SET image = $1 where id = $2';

    $result = pg_query_params($this->dbConnection, $sql, [
      $image,
      $section_id,
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success','Imagem da seção 2 atualizada com sucesso');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

  public function updateProfessionalExperience(
    Int $exp_id,
    String $company,
    String $description,
    Bool $actual_job,
    String $start_date,
    String $final_date
  ) {
    if (empty($company) || empty($description)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    if (!$actual_job) {
      if (empty($start_date) || empty($final_date)) {
        $this->session->create('error', 'Preencha os campos "De" e "Ate"');
        header('Location: /views/admin/change-home.php');
        exit;
      }
    }

    if ($actual_job) {
      $sql_get_actual_job = 'SELECT id FROM section_two_experiences WHERE actual_job = $1';

      $result = pg_query_params(
        $this->dbConnection,
        $sql_get_actual_job,
        [
          't'
        ]
      );

      if (!$result) {
        die(pg_last_error($this->dbConnection));
      }

      if (pg_num_rows($result) > 0) {
        $actual_job_exp = pg_fetch_assoc($result);

        if ($actual_job_exp['id'] == $exp_id) {
          $sql_update = 'UPDATE section_two_experiences SET company = $1, description = $2, actual_job = $3, start_date = $4, final_date = $5 where id = $6';

          $result = pg_query_params($this->dbConnection, $sql_update, [
            $company,
            $description,
            $actual_job ? 't' : 'f',
            $start_date,
            $final_date,
            $exp_id,  
          ]);

          if (!$result) {
            die(pg_last_error($this->dbConnection));
          }

          if (pg_affected_rows($result) > 0) {
            $this->session->create('success','Experiencia atualizada com sucesso');
            header('Location: /views/admin/change-home.php');
            exit;
          }
        } else {
          //Atulizar o registro antigo para actual_job = false e a final_date = date('Y-m-d')
          $sql_update_old = 'UPDATE section_two_experiences SET final_date = $1, actual_job = $2 where id = $3';

          $result_old = pg_query_params($this->dbConnection, $sql_update_old, [
            date('Y-m-d'),
            'f',
            $actual_job_exp['id'],
          ]);

          if (!$result_old) {
            die(pg_last_error($this->dbConnection));
          }
          //Atualizar o novo para actual_job = true
          $sql_update_new = 'UPDATE section_two_experiences SET company = $1, description = $2, actual_job = $3, start_date = $4, final_date = $5 where id = $6';

          $result_new = pg_query_params($this->dbConnection, $sql_update_new, [
            $company,
            $description,
            $actual_job ? 't' : 'f',
            $start_date,
            $final_date,
            $exp_id,
          ]);

          if (!$result_new) {
            die(pg_last_error($this->dbConnection));
          }

          if (pg_affected_rows($result) > 0) {
            $this->session->create('success','Experiencia atualizada com sucesso');
            header('Location: /views/admin/change-home.php');
            exit;
          }
        }
      } else {
        return null;
      }
    } else {
      $sql_update = 'UPDATE section_two_experiences SET company = $1, description = $2, actual_job = $3, start_date = $4, final_date = $5 where id = $6';

      $result = pg_query_params($this->dbConnection, $sql_update, [
        $company,
        $description,
        $actual_job ? 't' : 'f',
        $start_date,
        $final_date,
        $exp_id,
      ]);

      if (!$result) {
        die(pg_last_error($this->dbConnection));
      }

      if (pg_affected_rows($result) > 0) {
        $this->session->create('success','Experiencia atualizada com sucesso');
        header('Location: /views/admin/change-home.php');
        exit;
      }
    }
  }
}