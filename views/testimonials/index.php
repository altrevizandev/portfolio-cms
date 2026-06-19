<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Auth.php';
  require_once ROOT_PATH . 'classes/Testimonials.php';

  $testimonials = new Testimonials();

  if(isset($_GET['approved_testimonials'])) {
    if ($_GET['approved_testimonials'] == "true") {
      $approvedTestimonials = $testimonials->listAll(true);
    } else {
      if (!isset($_SESSION['user'])) {
        header('Location: /');
        exit;
      }

      if ($_SESSION['user']['user_role'] != "admin") {
        header('Location: /');
        exit;
      }

      $approvedTestimonials = $testimonials->listAll(false);
    }
  } else {
    $approvedTestimonials = $testimonials->listAll(true);
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
      Depoimentos - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-5">
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/error.php') ?>
      <?php include('../layouts/message.php') ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Depoimentos
          </li>
        </ol>
      </nav>

      <div class="mb-3 d-flex flex-sm-row align-items-sm-center justify-content-sm-between justify-content-md-start gap-3">
        <h1>Depoimentos</h1>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createTestimonialModal" data-bs-whatever="@createTestimonial">Deixe um depoimento</button>
        <?php if (isset($_SESSION['user'])) : ?>
          <?php if ($_SESSION['user']['user_role'] == "admin") : ?>
            <form action="/views/testimonials" method="get">
              <?php if (isset($_GET['approved_testimonials'])) : ?>
                <?php if ($_GET['approved_testimonials'] == "true") : ?>
                  <button type="submit" name="approved_testimonials" class="btn btn-primary btn-sm" value="false">Ver pendentes</button>
                <?php else: ?>
                  <button type="submit" name="approved_testimonials" class="btn btn-primary btn-sm" value="true">Ver aprovados</button>
                <?php endif; ?>
              <?php else : ?>
                <button type="submit" name="approved_testimonials" class="btn btn-primary btn-sm" value="false">Ver pendentes</button>
              <?php endif; ?>
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="modal fade" id="createTestimonialModal" tabindex="-1" aria-labelledby="createTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center gap-2">
              <div>
                <h1 class="modal-title fs-5 mb-3" id="createTestimonialModalLabel">Criando um depoimento</h1>
                <small>
                  <p>Então, quando você criar seu depoimento, ele não vai aparecer na tela logo de cara. Conhecendo meus amigos, eu preciso fazer uma moderação para não virar bagunça aqui. Se estiver ok, eu aprovo ele e ai sim ele aparece aqui. Desde já, te agradeço pela visita ao meu portfolio.</p>
                </small>
              </div>
              <button type="button" class="btn-close align-self-start" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form
                action="/actions/createTestimonial.php"
                enctype="multipart/form-data"
                method="post"
                id="create_testimonial_form"
              >
                <div class="mb-3 d-flex flex-column flex-md-row align-items-md-center gap-3">
                  <div>
                    <label for="recipient-name" class="col-form-label">Imagem</label>
                    <input type="file" accept="image/*" class="form-control" name="image" id="testimonial-img">
                  </div>
                  <img
                    src="https://static.vecteezy.com/system/resources/previews/024/983/914/non_2x/simple-user-default-icon-free-png.png"
                    class="rounded-circle img-fluid"
                    alt="User Picture"
                    style="width: 64px; height: 64px; object-fit: cover;"
                    id="testimonial-img-preview"
                  >
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nome</label>
                  <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Empresa</label>
                  <input type="text" class="form-control" name="company" required>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Cargo</label>
                  <input type="text" class="form-control" name="position" required>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Linkedin/Github</label>
                  <input type="text" class="form-control" name="social_link">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Escreva seu depoimento</label>
                  <textarea class="form-control" name="description" rows="5" required></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" form="create_testimonial_form" name="create_testimonial" class="btn btn-primary">Enviar depoimento</button>
            </div>
          </div>
        </div>
      </div>

      <?php if (count($approvedTestimonials) > 0) : ?>
        <div class="row g-4">
          <?php foreach ($approvedTestimonials as $testimonial) : ?>
            <div class="col-12 col-md-6">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="row align-items-center g-3">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-3">
                        <div class="col-auto">
                          <img
                            src="<?= $testimonial['image'] ? $testimonial['image'] : 'https://static.vecteezy.com/system/resources/previews/024/983/914/non_2x/simple-user-default-icon-free-png.png' ?>"
                            class="rounded-circle img-fluid"
                            alt="User Picture"
                            style="width: 64px; height: 64px; object-fit: cover;"
                          >
                        </div>

                        <div class="col">
                          <strong><?= $testimonial['name'] ?></strong>
                          <small class="d-block text-muted">
                            <?= $testimonial['position'] . " na " . $testimonial['company'] ?>
                          </small>
                        </div>
                      </div>
                      <?php if (isset($_SESSION['user'])) : ?>
                        <?php if ($_SESSION['user']['user_role'] == "admin") : ?>
                          <form
                            action="/actions/approveTestimonial.php"
                            method="post"
                          >
                            <input type="hidden" name="testimonial_id" value="<?= $testimonial['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" name="approve_testimonial">Aprovar</button>
                          </form>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <div class="col-12">
                      <p class="mb-0">
                        <?= nl2br($testimonial['description']) ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <h5>Por enquanto, sem depoimentos!</h5>
      <?php endif; ?>
    </div>
    <script src="/public/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>