<?php
  require_once './config/Constants.php';

require_once ROOT_PATH . 'classes/Stacks.php';
require_once ROOT_PATH . 'classes/SectionOne.php';
require_once ROOT_PATH . 'classes/SectionTwo.php';
require_once ROOT_PATH . 'classes/SectionThree.php';

print_r(password_hash('Alt@839517240999', PASSWORD_DEFAULT));
echo "<br>";
print_r(password_hash('visualizador', PASSWORD_DEFAULT));
exit;
$st = new Stacks();

$stacks = $st->listStacks();

$sectionOne = new SectionOne();
$sectionTwo = new SectionTwo();
$sectionThree = new SectionThree();

$sectionOneData = $sectionOne->getSectionOne();
$sectionTwoData = $sectionTwo->getSectionTwoData();
$formations = $sectionThree->getFormations();
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
      André Lucas Trevizan | Desenvolvedor Backend PHP, Node.js e PostgreSQL
    </title>
  </head>
  <body>
    <?php include('./views/layouts/navbar.php') ?>
    <div class="container py-5">
      <?php if ($sectionOneData != null) { ?>
        <div class="d-flex flex-column flex-lg-row justify-content-center gap-5 mb-5">
          <img
            src="<?= $sectionOneData['image'] ?>"
            class="img-fluid rounded-4"
            style="box-shadow: 0 0 40px rgba(0,0,0,.3); max-width: 500px;"
            alt="Andre"
          />
          <div>
            <div class="d-flex flex-column flex-md-row gap-2">
              <div class="mb-2">
                <h3><?= $sectionOneData['name'] ?></h3>
                <span class="badge text-bg-dark"><?= $sectionOneData['position'] ?></span>
              </div>
              <div class="border-start"></div>
              <div class="d-flex flex-column gap-2 text-sm">
                <span><?= $sectionOneData['address'] ?></span>
                <span><?= $sectionOneData['age'] ?> anos</span>
              </div>
            </div>

            <hr>

            <h3>Sobre mim</h3>

            <p style="text-align: justify;"><?= $sectionOneData['about'] ?></p>

            <hr>
            <div>
              <h3>Estudo e aprendizados</h3>
              <p style="text-align: justify;"><?= $sectionOneData['studies'] ?></p>
            </div>
            <hr>
            <div>
              <h3>Minhas principais stacks</h3>
              <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
                <?php foreach($sectionOneData['stacks'] as $stack) : ?>
                    <span class="badge rounded-pill bg-white text-dark border px-3 py-2 shadow-sm">
                      <i class="<?= $stack['stack_icon'] ?> me-1"></i>
                      <?= $stack['stack_name'] ?>
                    </span>
                  <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <h5>Dados da seção um ainda não foram cadastrados</h5>
      <?php } ?>
      <hr>
      <div class="d-flex flex-column-reverse flex-lg-row justify-content-between gap-5">
        <?php if (count($sectionTwoData['experiences']) > 0) { ?>
          <div class="d-flex flex-column gap-3">
            <?php foreach($sectionTwoData['experiences'] as $experience) : ?>
              <div class="d-flex flex-column">
                <div class="d-flex gap-3 align-items-center">
                  <h5><?= $experience['company'] ?></h5>
                  <div class="d-flex flex-column gap-2 text-sm">
                    <?php if ($experience['actual_job'] == 't') { ?>
                      <span class="badge text-bg-primary"><?= date('d/m/Y', strtotime($experience['start_date'])) ?> - atual</span>
                    <?php } else { ?>
                      <span
                        class="badge text-bg-primary"
                      ><?= date('d/m/Y', strtotime($experience['start_date'])) ?> - <?= date('d/m/Y', strtotime($experience['final_date'])) ?>
                      </span>
                    <?php } ?>
                  </div>
                </div>
                <p style="text-align: justify;"><?= $experience['description'] ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <?php if ($sectionTwoData['image']) : ?>
            <img
              src="<?= $sectionTwoData['image'] ?>"
              class="img-fluid rounded-4"
              style="box-shadow: 0 0 40px rgba(0,0,0,.3); width: auto; max-height: 700px;"
              alt="Imagem da seção 2"
            />
          <?php endif; ?>
        <?php } else { ?>
          <h5>As experiencias profissionais que você cadastrar vão aparecer aqui</h5>
        <?php } ?>
      </div>
      <hr>
      <div class="d-flex flex-column align-items-center">
        <h3 class="mb-5">Formação</h3>
        <?php if (count($formations) > 0) { ?>
          <?php foreach($formations as $formation) : ?>
            <div class="d-flex flex-column align-items-center justify-content-center mb-5 w-100" style="max-width: 700px;">
              <div class="d-flex justify-content-center align-items-center gap-2">
                <h5><?= $formation['course'] ?> - <?= $formation['institution'] ?> <small>(<?= date('m/Y', strtotime($formation['start_date'])); ?><?= $formation['still_studying'] == 't' ? "" : '- ' . date('m/Y', strtotime($formation['final_date'])); ?>)</small></h5>
              </div>
              <p class="text-center"><?= $formation["description"] ?></p>
              <div class="d-flex align-items-center justify-content-center">
                <?php 
                  switch($formation["situation"]) {
                    case "formado":
                      echo "<span class='badge text-bg-success'>Formado</span>";
                      break;
                    case "nao-finalizado":
                      echo "<span class='badge text-bg-primary'>Não finalizado</span>";
                      break;
                    case "em-andamento":
                      echo "<span class='badge text-bg-warning'>Em andamento</span>";
                      break;
                  } 
                ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php } else { ?>
            <h5>As formações que você cadastrar vão aparecer aqui</h5>
        <?php } ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>