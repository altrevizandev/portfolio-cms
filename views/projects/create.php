<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Stacks.php';

  if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
  }

  if ($_SESSION['user']['user_role'] != "admin") {
    header('Location: /');
    exit;
  }

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
      Criar Projetos - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column gap-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/views/projects">Projetos</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Criando novo projeto
          </li>
        </ol>
      </nav>
      <h3>Criando novo projeto</h3>
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/error.php') ?>
      <?php include('../layouts/message.php') ?>
      <form
        action="/actions/createProject.php"
        method="post"
        enctype="multipart/form-data"
      >
        <div class="mb-3">
          <label class="form-label">Título</label>
          <input type="text" name="prj_title" class="form-control" placeholder="Entre com o título do projeto" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Descrição</label>
          <textarea type="text" name="prj_description" class="form-control" placeholder="Entre com a descrição do projeto" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Desafio</label>
          <textarea type="text" name="prj_challenge" class="form-control" placeholder="Entre com a descrição do projeto" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Solução</label>
          <textarea type="text" name="prj_solution" class="form-control" placeholder="Entre com a descrição do projeto" required></textarea>
        </div>
        <div class="mb-3 form-check">
          <input class="form-check-input" type="checkbox" id="checkDefault" name="prj_corporative">
          <label class="form-check-label" for="checkDefault">
            Esse foi um corporativo?
          </label>
        </div>
        <div class="mb-3">
          <label class="form-label">Selecione as stacks que você usou para criar esse projeto</label>
          <div class="d-flex gap-3">
            <?php if (count($stacks) > 0) { ?>
              <div class="d-flex gap-2 justify-content-around flex-wrap">
                <?php foreach( $stacks as $stack ) { ?>
                  <div class="form-check d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" 
                    value="<?= $stack['id'] ?>" name="prj_stacks[]" id="check_<?= $stack['name'] ?>">
                    <span class="badge rounded-pill bg-white text-dark border px-3 py-2 shadow-sm">
                      <i class="<?= $stack['icon'] ?> me-1"></i>
                      <label class="form-check-label" for="check_<?= $stack['name'] ?>">
                        <?= $stack['name'] ?>
                      </label>
                    </span>
                  </div>
                <?php } ?>
              </div>
            <?php } else { ?>
              <h5>Nenhuma stack cadastrada</h5>
            <?php } ?>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Thumbnail</label>
          <input type="file" class="form-control" aria-label="file example" required name="prj_thumbnail" accept="image/*">
        </div>
        <div class="mb-3">
          <?php if (isset($_SESSION['user'])) : ?>
            <?php if ($_SESSION['user']['user_role'] == "admin") : ?>
              <button type="submit" name="create_project" class="btn btn-success btn-sm">Criar</button>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </body>
</html>