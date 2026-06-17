<?php
  require_once '../../config/Constants.php';

  require_once ROOT_PATH . 'classes/Auth.php';

  $auth = new Auth();

  if (isset($_SESSION['user'])) {
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
      Login - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../layouts/navbar.php') ?>
    <div class="container py-5 d-flex align-items-center justify-content-center">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card shadow-lg border-0">
            <div class="card-body p-5">
              <div class="row g-5 align-items-center">
                <div class="col-md-4 col-md-center">
                  <img
                    src="/public/images/login.jpeg"
                    class="img-fluid rounded-4 shadow"
                    style="max-width: 250px;"
                    alt="Andre"
                  />
                  <h3 class="mt-3">
                    André Lucas Trevizan
                  </h3>
                  <p>
                    Desenvolvedor Backend PHP, Node.js e PostgreSQL
                  </p>
                </div>
                <div class="col-md-4 col-md-center">
                  <div class="p-3">
                    <h4 class="text-center">Portfolio - Acesso</h4>
                  </div>
                  <p class="text-center">
                    Olá visitante, <br><br>
                    
                    Você pode usar as credenciais que vou deixar em destaque para acessar meu sistema.<br><br>

                    O acesso é apenas para demonstrar um login funcional tornando a experiência mais imersiva, e também para que você possa ver como eu faço manutenção nos usuários, projetos, stacks, contatos e homepage.<br><br>

                    Todas as ações de <strong>criar</strong>, <strong>editar</strong> e <strong>deletar</strong> dentro do sistema são restritas a administradores, no caso, eu.<br><br>
                    <span>Seja bem-vindo(a)! 😊</span>
                  </p>
                </div>
                <div class="col-md-4">
                  <form action="../actions/Login.php" method="post" class="w-full mb-3">
                    <?php include('../layouts/error.php') ?>
                    <?php include('../layouts/message.php') ?>
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input name="user_email" type="email" class="form-control" placeholder="Entre com seu e-mail">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Senha</label>
                      <input name="user_password" type="password" class="form-control" placeholder="Entre com sua senha">
                    </div>
                    <button type="submit" class="btn btn-primary" name="handle_login">Entrar</button>
                  </form>
                  <div class="alert alert-info">
                    <h6>Conta de demonstração</h6>

                    <strong>Email:</strong>
                    portfolioviewer@gmail.com

                    <br>

                    <strong>Senha:</strong>
                    visualizador
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>