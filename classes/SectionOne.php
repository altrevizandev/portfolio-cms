<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . 'config/Database.php';
require_once ROOT_PATH . 'classes/Session.php';
require_once ROOT_PATH . 'classes/Stacks.php';

class SectionOne {
  private Database $db;
  private Session $session;
  private mixed $dbConnection;

  public function __construct() {
    $this->db = new Database();
    $this->dbConnection = $this->db->connect();
    $this->session = new Session();
  }

  public function getSectionOne() {
    $sql = '
      select
        so.id,
        so.image,
        so.name,
        so.position,
        so.address,
        so.birth_date,
        so.about,
        so.studies,
        s.id as stack_id,
        s.name as stack_name,
        s.icon as stack_icon
      from section_one so
      left join section_stacks ss
        on ss.section_id = so.id
      left join stacks s
        on s.id = ss.stack_id
      order by so.id;';

    $result_session_one = pg_query(
      $this->dbConnection,
      $sql,
    );

    if (!$result_session_one) {
      die(pg_last_error($this->dbConnection));
    }

    $db_result_array = pg_fetch_all($result_session_one);

    $sectionOne = [];
    $stacks = [];
    $finalList = [];

    for ($count = 0; $count < count($db_result_array); $count++) { //12
      if ($db_result_array[$count]['id'] == $db_result_array[$count+1]['id']) {
        array_push(
          $stacks, [
            "stack_id" => $db_result_array[$count]['stack_id'],
            "stack_name" => $db_result_array[$count]['stack_name'], "stack_icon" => $db_result_array[$count]['stack_icon']
          ]
        );
      } else {
        array_push(
          $stacks, [
            "stack_id" => $db_result_array[$count]['stack_id'],
            "stack_name" => $db_result_array[$count]['stack_name'], "stack_icon" => $db_result_array[$count]['stack_icon']
          ]
        );

        $birthDate = new DateTime($db_result_array[$count]['birth_date']);

        $today = new DateTime();

        $age = $today->diff($birthDate)->y;
        
        array_push(
          $sectionOne, [
            "id" => $db_result_array[$count]['id'], "name" => $db_result_array[$count]['name'],  "position" => $db_result_array[$count]['position'], "image" => $db_result_array[$count]['image'], "stacks" => $stacks, "studies" => $db_result_array[$count]['studies'], "about" => $db_result_array[$count]['about'], "address" => $db_result_array[$count]['address'], "age" => $age, "birth_date" => $db_result_array[$count]['birth_date']
          ]
        );

        array_push($finalList, $sectionOne[0]);

        $sectionOne = [];
        $stacks = [];
      }
    }

    return $finalList;
  }

  public function create(
    String $image,
    String $name,
    String $address,
    String $birth_date,
    String $position,
    String $about_me,
    String $studies,
    Array $section_stacks,
  ) {
    if (empty($image) || empty($name) || empty($address) || empty($birth_date) || empty($position) || empty($about_me) || empty($studies)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'INSERT INTO section_one (name, address, birth_date, position, about, studies, image) VALUES ($1, $2, $3, $4, $5, $6, $7) RETURNING id';

    $result = pg_query_params($this->dbConnection, $sql, [
      $name,
      $address,
      $birth_date,
      $position,
      $about_me,
      $studies,
      $image
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $section = pg_fetch_assoc($result);

      $stacks = new Stacks();

      $stacksCreated = $stacks->createSectionStacks($section_stacks, $section['id']);

      if ($stacksCreated) {
        $this->session->create('success','Seção 1 criada com sucesso');
        header('Location: /views/admin/change-home.php');
        exit;
      } else {
        $this->session->create('error','Erro ao criar a seção 1');
        header('Location: /views/admin/change-home.php');
        exit;
      }
    } else {
      $this->session->create('error','Erro ao criar a seção 1');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }
  
  public function update(
    Int $section_id,
    String $image,
    String $name,
    String $address,
    String $birth_date,
    String $position,
    String $about_me,
    String $studies,
    Array $section_stacks,
  ) {
    if (empty($image) || empty($name) || empty($address) || empty($birth_date) || empty($position) || empty($about_me) || empty($studies)) {
      $this->session->create('error', 'Preencha todos os campos');
      header('Location: /views/admin/change-home.php');
      exit;
    }

    $sql = 'UPDATE section_one SET name = $1, address = $2, birth_date = $3, position = $4, about = $5, studies = $6, image = $7 where id = $8';

    $result = pg_query_params($this->dbConnection, $sql, [
      $name,
      $address,
      $birth_date,
      $position,
      $about_me,
      $studies,
      $image,
      $section_id
    ]);

    if (!$result) {
      die(pg_last_error($this->dbConnection));
    }

    if (pg_affected_rows($result) > 0) {
      $stacks = new Stacks();

      $stacksCreated = $stacks->updateSectionStacks($section_stacks, $section_id);

      if ($stacksCreated) {
        $this->session->create('success','Seção 1 atualizada com sucesso');
        header('Location: /views/admin/change-home.php');
        exit;
      } else {
        $this->session->create('error','Erro ao atualizar a seção 1');
        header('Location: /views/admin/change-home.php');
        exit;
      }
    } else {
      $this->session->create('error','Erro ao atualizar a seção 1');
      header('Location: /views/admin/change-home.php');
      exit;
    }
  }

}