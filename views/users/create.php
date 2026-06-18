<?php 
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Auth.php';

  if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
  }

  if ($_SESSION['user']['user_role'] != "admin") {
    header('Location: /');
    exit;
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
      Criar Usuários - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column">
      <?php include('../layouts/success.php') ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/views/admin">Admin</a></li>
          <li class="breadcrumb-item"><a href="/views/users">Usuários</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Criar usuário
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h2 class="mb-0">Criando Usuário</h2>

        <a href="/views/users" class="btn btn-danger btn-sm">
          Cancelar e voltar
        </a>
      </div>
      <div>
        <?php include('../layouts/error.php') ?>
        <?php include('../layouts/message.php') ?>
        <form
          action="../../actions/createUser.php"
          method="POST"
          class="d-flex flex-column gap-4 w-100"
        >
          <div>
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="user_name" placeholder="Entre com o nome do usuário" required>
          </div>
          <div>
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="user_email" placeholder="Entre com o email do usuário" required>
          </div>
          <div>
            <label class="form-label">Data de Nascimento</label>
            <input
              type="date"
              class="form-control"
              name="user_birth_date"
              max="<?= date('Y-m-d') ?>"
              required
            >
          </div>
          <div>
            <label class="form-label">Senha</label>
            <div class="input-group">
              <input
                type="password"
                class="form-control"
                name="user_password"
                id="user_password"
              >

              <button
                class="btn btn-outline-secondary"
                type="button"
                id="toggle-password"
              >
                👁️
              </button>
            </div>
          </div>
          <div>
            <label class="form-label">Descrição</label>
            <textarea name="user_description" class="form-control" rows="5" placeholder="Entre com uma descrição para o usuário" required></textarea>
          </div>
          <div>
            <label class="form-label">Função</label>
            <select class="form-select" aria-label="Default select example" required name="user_role">
              <option value="" selected disabled>
                Escolha uma função para o usuário
              </option>
              <option value="admin">Administrador</option>
              <option value="viewer">Visualizador</option>
            </select>
          </div>
          <div class="d-grid d-md-block">
            <?php if (isset($_SESSION['user'])) : ?>
              <?php if ($_SESSION['user']['user_role'] == 'admin') : ?>
                <button
                  name="create_user"
                  class="btn btn-primary" type="submit">
                  Criar
                </button>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </form> 
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>