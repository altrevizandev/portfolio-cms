<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Auth.php';

  if (!isset($_GET['user_name'])) {
    header('Location: /views/users');
    exit;
  }

  if (empty($_GET['user_name'])) {
    header('Location: /views/users');
    exit;
  }

  $user_name = "%".trim($_GET['user_name'])."%";

  $user = new User();

  $userSearch = $user->searchUser($user_name);
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
      Buscar Usuários - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column gap-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/views/admin">Admin</a></li>
          <li class="breadcrumb-item"><a href="/views/users">Usuários</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Buscando usuários
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h2 class="mb-0">Resultado da busca por Usuários</h2>

        <a
          href="javascript:history.back()"
          class="btn btn-danger btn-sm"
        >
          Voltar
        </a>
      </div>
      <hr>
      <h5><?= count($userSearch); ?> resultados encontrados</h5>
      <div class="d-flex flex-wrap gap-4">
        <?php
          if (count($userSearch) > 0) :
            foreach ($userSearch as $user) {
        ?>
            <div class="col-12 col-md-6 col-lg-4">

              <div class="card h-100">

                <div class="card-body">

                  <h5 class="card-title">
                    <?= $user["user_name"] ?>
                  </h5>

                  <p class="card-text">
                    <?= $user["user_description"] ?>
                  </p>

                </div>

                <?php if (isset($_SESSION['user'])) : ?>
                  <?php if ($_SESSION['user']['user_role']) : ?>
                    <div class="card-footer d-flex flex-wrap gap-2">
                      <a href="/views/users/details.php?user_id=<?= $user["id"] ?>" class="btn btn-primary btn-sm">Ver</a>
                      <a href="/views/users/edit.php?user_id=<?= $user["id"] ?>" class="btn btn-warning btn-sm">Editar</a>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal<?= $user['id'] ?>">
                        Deletar
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="deleteUserModal<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteUserModalLabel<?= $user['id'] ?>">Deletar Usuário?</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Deseja mesmo deletar este usuário?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              <form action="/actions/deleteUser.php" method="post">
                                <input name="user_id" type="text" hidden value="<?= $user['id'] ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger">Sim, quero deletar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>

              </div>

            </div>
        <?php
            }
          endif;
        ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>