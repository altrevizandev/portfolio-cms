<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . 'classes/Session.php';
require_once ROOT_PATH . 'classes/Stacks.php';


require_once ROOT_PATH . 'config/Database.php';

class Testimonials {
  private Session $session;
  private Database $db;
  private mixed $dbConnection;

  public Int $id;
  public String $name;
  public String $company;
  public String $position;
  public String $social_link;
  public String $description;
  public String $image;
  public Bool $approved;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function create() {
    $sql = 'INSERT INTO testimonials (name, company, position, description, image, social_link) VALUES ($1, $2, $3, $4, $5, $6)';

    $result = pg_query_params($this->dbConnection, $sql, [
      $this->name,
      $this->company,
      $this->position,
      $this->description,
      $this->image,
      $this->social_link
    ]);

    if (!$result) {
      $error = pg_last_error($this->dbConnection);
      $this->session->create("error", $error);
      header('Location: /views/testimonials');
      exit;
    }

    $this->session->create("success", "Depoimento criado com sucesso");
    header('Location: /views/testimonials');
    exit;
  }
  
  public function approve() {
    $sql = 'UPDATE testimonials SET approved = $1 WHERE id = $2;';

    $result = pg_query_params($this->dbConnection, $sql, [
      "t",
      $this->id
    ]);

    if (!$result) {
      $error = pg_last_error($this->dbConnection);
      $this->session->create("error", $error);
      header('Location: /views/testimonials');
      exit;
    }

    $this->session->create("error", "Depoimento atualizado com sucesso");
    header('Location: /views/testimonials');
    exit;
  }
  
  public function listAll(Bool $approved = false) {
    $sql = 'SELECT * FROM testimonials WHERE approved = $1';

    $result = pg_query_params($this->dbConnection, $sql, [
      $approved ? "t" : "f  "
    ]);

    if (!$result) {
      $error = pg_last_error($this->dbConnection);
      $this->session->create("error", $error);
      header('Location: /views/testimonials');
      exit;
    }

    return pg_fetch_all($result) ?: [];
  }
  
  public function getById(Int $testimonial_id) {
    $sql = 'SELECT * FROM testimonials WHERE approved = $1';

    $result = pg_query_params($this->dbConnection, $sql, [
      $testimonial_id
    ]);

    if (!$result) {
      $error = pg_last_error($this->dbConnection);
      $this->session->create("error", $error);
      header('Location: /views/testimonials');
      exit;
    }

    if (pg_num_rows($result) > 0) {
      $testimonial = pg_fetch_assoc($result);

      return $testimonial;
    } else {
      return null;
    }
  }
}