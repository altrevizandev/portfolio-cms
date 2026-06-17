<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Stacks.php';

  $st = new Stacks();

  $stacks = $st->listStacks();
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
      Stacks - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3">
      <?php include('../layouts/success.php') ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/views/admin">Admin</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Stacks
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h3 class="mb-0">Stacks</h3>

        <a href="/views/stacks/create.php" class="btn btn-success btn-sm">
          Criar
        </a>
      </div>
      <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
        <?php if (count($stacks) > 0) { ?>
          <form class="d-flex flex-column gap-5" action="/views/stacks/edit.php" method="get">
            <div class="d-flex flex-wrap gap-3 justify-content-center">
              <?php foreach( $stacks as $stack ) { ?>
                <div class="form-check d-flex align-items-center gap-2">
                  <input class="form-check-input" type="radio" 
                  value="<?= $stack['id'] ?>" name="stack_id" id="check_<?= $stack['name'] ?>">
                  <span class="badge rounded-pill bg-white text-dark border px-3 py-2 shadow-sm">
                    <i class="<?= $stack['icon'] ?> me-1"></i>
                    <label class="form-check-label" for="check_<?= $stack['name'] ?>">
                      <?= $stack['name'] ?>
                    </label>
                  </span>
                </div>
              <?php } ?>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3">
              <button class="btn btn-warning btn-sm">Editar</button>
            </div>
          </form>
        <?php } else { ?>
          <h5>Nenhuma stack cadastrada</h5>
        <?php } ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>