<?php

require_once "Constants.php";

class Database {
  private $connection;

  public function connect() {
    $this->connection = pg_connect(
      "host=" . HOST .
      " port=" . PORT .
      " dbname=" . DB .
      " user=" . USER .
      " password=" . PASSWORD
    );

    if (!$this->connection) {
      throw new Exception("Houve um erro ao conectar com o banco de dados");
    }

    return $this->connection;
  }
}
