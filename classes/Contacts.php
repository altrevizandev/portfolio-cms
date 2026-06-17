<?php

require_once __DIR__ . '/../config/Constants.php';

require_once __DIR__ . '/../config/Database.php';

require_once ROOT_PATH . '../classes/Session.php';

class Contacts {
  private Session $session;
  private Database $db;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function addContact(
    String $phone,
    String $email,
    String $github,
    String $linkedin
  ) {
    if (empty($phone) || empty($email) || empty($github) || empty($linkedin)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/contact');
      exit;
    }

    $sql = 'INSERT INTO contacts (phone, email, github, linkedin) VALUES ($1, $2, $3, $4);';

    $result = pg_query_params($this->dbConnection, $sql, [
      $phone,
      $email,
      $github,
      $linkedin
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success', 'Contato criado com sucesso');
      header('Location: /views/contact');
      exit;
    } else {
      return false;
    }
  }

  public function getContacts() {
    $sql = 'SELECT * FROM contacts;';

    $result = pg_query($this->dbConnection, $sql);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    return pg_fetch_all($result) ?: [];
  }

  public function update(
    Int $contact_id,
    String $phone,
    String $email,
    String $github,
    String $linkedin
  ) {
    $sql = 'UPDATE contacts SET phone = $1, email = $2, github = $3, linkedin = $4 WHERE id = $5';

    $result = pg_query_params($this->dbConnection, $sql, [
      $phone,
      $email,
      $github,
      $linkedin,
      $contact_id,
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $this->session->create('success', 'Contato atualizado com sucesso');
      header('Location: /views/contact');
      exit;
    } else {
      return false;
    }
  }
}