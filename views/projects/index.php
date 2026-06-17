<?php 
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . '../classes/Projects.php';

  if(isset($_GET['disabled_projects'])) {
    if ($_GET['disabled_projects'] == "true") {
      $projects = new Project()->listProjects(true);
    } else {
      $projects = new Project()->listProjects(false);
    }
  } else {
    $projects = new Project()->listProjects(false);
  }
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
      Projetos - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column gap-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Projetos
          </li>
        </ol>
      </nav>
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/error.php') ?>
      <?php include('../layouts/message.php') ?>
      <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
        <h3>Meus projetos</h3>
        <div class="d-flex flex-wrap gap-2">
          <a href="/views/projects/create.php" class="btn btn-success btn-sm align-self-start">Criar</a>
          <form action="/views/projects" method="get">
            <?php if ($_GET['disabled_projects'] == "true") { ?>
              <button type="submit" name="disabled_projects" class="btn btn-primary btn-sm" value="false">Ver projetos ativos</button>
            <?php } else { ?>
              <button type="submit" name="disabled_projects" class="btn btn-primary btn-sm" value="true">Ver projetos inativos</button>
            <?php } ?>
          </form>
        </div>
      </div>
      <div>
        <div class="row g-4">
          <?php if (count($projects) > 0) { ?>
            <?php foreach ($projects as $project) : ?>
              <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100">
                  <img src="<?= $project['prj_thumbnail'] ?>" class="card-img-top" alt="..." style="height: 200px;object-fit: cover;">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $project['prj_title'] ?></h5>
                    <p class="card-text" style="
                      display:-webkit-box;
                      -webkit-line-clamp:4;
                      -webkit-box-orient:vertical;
                      overflow:hidden;
                    "><?= $project['prj_description'] ?></p>
                    <hr>
                    <h6 class="mb-3">Stack</h6>
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-4 mb-3">
                      <?php foreach($project['stacks'] as $stack) : ?>
                        <span class="badge rounded-pill bg-white text-dark border px-3 py-2 shadow-sm">
                          <i class="<?= $stack['stack_icon'] ?> me-1"></i>
                          <?= $stack['stack_name'] ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                    <div class="mt-auto">
                      <a href="/views/projects/details.php?project_id=<?= $project["id"] ?>" class="btn btn-primary w-100">Ver Projeto</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php } else { ?>
            <h5>Nenhum projeto foi encontrado até agora</h5>
          <?php } ?>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>