<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . '../classes/Auth.php';

  if (!isset($_GET["user_id"])) {
    header('Location: ./index.php');
    exit;
  }

  if (empty($_GET['user_id'])) {
    header('Location: ./index.php');
    exit;
  }

  $userId = trim($_GET['user_id']);

  $user = new User();

  $userDetails = $user->findById($userId);
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
      Detalhes de Usuário - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column gap-2">
      <?php include('../layouts/success.php') ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/views/admin">Admin</a></li>
          <li class="breadcrumb-item"><a href="/views/users">Usuários</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Visualizar usuário
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h2 class="mb-0">Visualizando Usuário</h2>
        <a href="/views/users" class="btn btn-danger btn-sm">Voltar</a>
      </div>
      <div class="d-flex flex-column gap-4">
        <div>
          <label class="form-label">Nome</label>
          <p class="form-control"><?= $userDetails['user_name']; ?></p>
        </div>
        <div>
          <label class="form-label">E-mail</label>
          <p class="form-control"><?= $userDetails['user_email']; ?></p>
        </div>
        <div>
          <label class="form-label">Data de Nascimento</label>
          <p class="form-control">
            <i class="bi bi-calendar-event me-2"></i>
            <?= date('d/m/Y', strtotime($userDetails['user_birth_date'])) ?>
          </p>
        </div>
        <div>
          <label class="form-label">Descrição</label>
          <p class="form-control"><?= nl2br(htmlspecialchars($userDetails['user_description'])); ?></p>
        </div>
        <div>
          <label class="form-label">Função</label>
          <?php if ($userDetails['user_role'] == 'admin') : ?>
            <span class="badge text-bg-danger">
              Administrador
            </span>
          <?php else : ?>
            <span class="badge text-bg-primary">
              Visualizador
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>