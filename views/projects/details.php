<?php 
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . '../classes/Projects.php';

  if (!isset($_GET['project_id'])) {
    header('Location: /views/projects');
    exit;
  }

  $project_id = $_GET['project_id'];

  $prj = new Project();

  $projectDetails = $prj->findById($project_id);
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/public/images/favicon.ico">
    <link rel="apple-touch-icon" href="/public/images/favicon-andre.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <meta
      name="description"
      content="Portfólio de André Lucas Trevizan, Desenvolvedor Backend com foco em PHP, Node.js, PostgreSQL, APIs REST, Docker."
    >
    <meta property="og:title" content="André Lucas Trevizan">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://altrevizan.com.br">
    <meta property="og:image" content="https://altrevizan.com.br/public/images/eu.jpeg">
    <meta property="og:description" content="Desenvolvedor Backend PHP, Node.js e PostgreSQL">
    <meta name="author" content="André Lucas Trevizan">
    <meta
      name="keywords"
      content="
      André Lucas Trevizan,
      Desenvolvedor Backend,
      PHP,
      Node.js,
      PostgreSQL,
      Docker,
      Fastify,
      APIs REST,
      SAP,
      Integrações
    ">
    <meta name="theme-color" content="#212529">
    <link rel="canonical" href="https://altrevizan.com.br">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Portfólio André Lucas Trevizan">
    <meta name="robots" content="index, follow">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="André Lucas Trevizan">
    <meta name="twitter:description" content="Desenvolvedor Backend PHP, Node.js e PostgreSQL">
    <meta name="twitter:image" content="https://andretrevizan.com/public/images/eu.jpeg">
    <title>
      Detalhes do projeto - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/views/projects">Projetos</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Visualizando <?= $projectDetails["prj_title"] ?>
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column gap-3">
        <?php include('../layouts/success.php') ?>
        <?php include('../layouts/error.php') ?>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
          <div class="d-flex align-items-center gap-2">
            <h3><?= $projectDetails["prj_title"] ?></h3>
            <?php if ($projectDetails["prj_corporative"] == 't'): ?>
              <span class="badge text-bg-dark">
                <i class="bi bi-shield-lock-fill"></i>
                Projeto Corporativo
              </span>
            <?php endif; ?>
          </div>
          <div class="d-flex gap-2">
            <a
              href="/views/projects/edit.php?project_id=<?= $projectDetails['id'] ?>"
              class="btn btn-warning btn-sm"
            >
              Editar
            </a>

            <button
              type="button"
              class="btn btn-danger btn-sm"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
            >
              Deletar
            </button>
          </div>
        </div>
        <p><?= $projectDetails["prj_description"] ?></p>
        <img
          src="<?= $projectDetails["prj_thumbnail"] ?>"
          class="img-fluid rounded-4"
          style="box-shadow: 0 0 40px rgba(0,0,0,.3); max-height: 600px; object-fit: cover;"
          alt="Thumbnail"
        />
        <h5>Stacks que foram usadas</h5>
        <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
          <?php foreach($projectDetails['stacks'] as $stack) : ?>
              <span class="badge rounded-pill bg-white text-dark border px-3 py-2 shadow-sm">
                <i class="<?= $stack['icon'] ?> me-1"></i>
                <?= $stack['name'] ?>
              </span>
            <?php endforeach; ?>
        </div>
        <h5>Desafio</h5>
        <p><?= $projectDetails["prj_challenge"] ?></p>
        <h5>Solução</h5>
        <p><?= $projectDetails["prj_solution"] ?></p>
        <h5>Resultados</h5>
        <ul>
          <li>Redução do tempo de atendimento;</li>
          <li>Menor dependência da equipe de suporte;</li>
          <li>Processo disponível para utilização pelos usuários;</li>
          <li>Integração segura com o ambiente SAP;</li>
        </ul>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Deletar Projeto?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Deseja mesmo deletar este projeto?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <form action="/actions/deleteStack.php" method="post">
                <input name="stack_id" type="text" hidden value="<?= $projectDetails['id'] ?>">
                <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                  <button type="submit" name="delete_stack" class="btn btn-danger">Sim, quero deletar</button>
                <?php } else { ?>
                  <button disabled type="submit" name="delete_stack" class="btn btn-danger">Sim, quero deletar</button>
                <?php } ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>