<?php 

  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Auth.php';

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
      Admin - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Admin
          </li>
        </ol>
      </nav>
      <h3 class="mb-5">Painel Administrativo</h3>
      <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
          <a href="/views/users" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-people"></i>
            <span>Usuários</span>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
          <a href="/views/projects" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-folder-symlink-fill"></i>
            <span>Projetos</span>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
          <a href="/views/stacks" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-stack"></i>
            <span>Stacks</span>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
          <a href="/views/contact" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-telephone-fill"></i>
            <span>Contato</span>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
          <a href="/views/admin/change-home.php" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-house-gear"></i>
            <span>Mudar a home</span>
          </a>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>