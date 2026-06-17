<?php 
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . '../classes/Contacts.php';

  $cts = new Contacts();

  $contacts = $cts->getContacts();
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
      Contatos - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container d-flex flex-column gap-3 py-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Contato
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h3>Meios de entrar em contato comigo</h3>
        <?php if (count($contacts) == 0) { ?>
          <?php if ($_SESSION['user']['user_role'] == 'admin') { ?>
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropSession1" aria-controls="staticBackdropSession1">
            Criar
            </button>
          <?php } else {?>
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropSession1" aria-controls="staticBackdropSession1" disabled>
            Criar
            </button>
          <?php } ?>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropSession1" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Criando contato</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form action="/actions/createContact.php" method="post">
                <div class="mb-3">
                  <div class="d-flex flex-column form-label">
                    <label>Telefone</label>
                    <small>Formato: <strong>xx x xxxx-xxxx</strong></small>
                  </div>
                  <input class="form-control" type="tel" name="phone" placeholder="Entre com seu telefone"
                  pattern="[0-9]{2} [0-9]{1} [0-9]{4}-[0-9]{4}">
                </div>
                <div class="mb-3">
                  <label class="form-label">E-mail</label>
                  <input class="form-control" type="email" name="email" placeholder="Entre com seu e-mail">
                </div>
                <div class="mb-3">
                  <label class="form-label">Perfil do Gtihub</label>
                  <input class="form-control" type="text" name="github" placeholder="http://">
                </div>
                <div class="mb-3">
                  <label class="form-label">Perfil do Linkedin</label>
                  <input class="form-control" type="text" name="linkedin" placeholder="https://">
                </div>
                <div>
                  <button name="create_contact" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                </div>
              </form>
            </div>
          </div>
        <?php } else { ?>
          <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropEditContact" aria-controls="staticBackdropEditContact">
            Editar
          </button>
        <?php } ?>
      </div>
      <?php include('../layouts/error.php') ?>
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/message.php') ?>
      <?php if (count($contacts) > 0) { ?>
        <?php foreach($contacts as $contact) : ?>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropEditContact" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Editando contato</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form action="/actions/updateContact.php" method="post">
                <div class="mb-3">
                  <div class="d-flex flex-column form-label">
                    <label>Telefone</label>
                    <small>Formato: <strong>xx x xxxx-xxxx</strong></small>
                  </div>
                  <input class="form-control" type="tel" name="phone" placeholder="Entre com seu telefone"
                  pattern="[0-9]{2} [0-9]{1} [0-9]{4}-[0-9]{4}" value="<?= $contact['phone'] ?>">
                </div>
                <div class="mb-3">
                  <label class="form-label">E-mail</label>
                  <input class="form-control" type="email" name="email" placeholder="Entre com seu e-mail" value="<?= $contact['email'] ?>">
                </div>
                <div class="mb-3">
                  <label class="form-label">Perfil do Gtihub</label>
                  <input class="form-control" type="text" name="github" placeholder="http://" value="<?= $contact['github'] ?>">
                </div>
                <div class="mb-3">
                  <label class="form-label">Perfil do Linkedin</label>
                  <input class="form-control" type="text" name="linkedin" placeholder="https://" value="<?=  $contact['linkedin'] ?>">
                </div>
                <div>
                  <?php if ($_SESSION['user']['user_role'] == 'admin') { ?>
                    <button name="update_contact" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                  <?php } else {?>
                    <button disabled name="update_contact" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                  <?php } ?>
                </div>
              </form>
            </div>
          </div>
          <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column flex-md-row gap-3">
              <div class="d-flex flex-column gap-2 flex-fill">
                <label>Telefone</label>
                <span class="form-control"><strong><?= $contact['phone'] ?></strong></span>
              </div>
              <div class="d-flex flex-column gap-2 flex-fill">
                <label>E-mail</label>
                <span class="form-control"><strong><?= $contact['email'] ?></strong></span>
              </div>
            </div>
            <div class="d-flex gap-2 mt-4">
              <a href="<?= $contact['github'] ?>" target="_blank" class="btn btn-dark">
                <i class="bi bi-github"></i>
                GitHub
              </a>
              <a href="<?= $contact['linkedin'] ?>" target="_blank" class="btn btn-primary">
                <i class="bi bi-linkedin"></i>
                LinkedIn
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php } else { ?>
        <h5 class="text-center">Nenhuma informação de contato foi criada</h5>
      <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>