<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-md">

    <a href="/" class="navbar-brand">
      <span class="fs-2 fw-bold">
        Portfolio
      </span>
    </a>

    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarMain"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">

      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Sobre mim</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/views/projects">Projetos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/views/contact">Contato</a>
        </li>

        <?php if (isset($_SESSION['user'])) : ?>
          <?php if ($_SESSION['user']['user_role'] == "admin") : ?>
            <li class="nav-item">
              <a class="nav-link" href="/views/admin">Admin</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <?php if (isset($_SESSION['user'])) : ?>

        <div class="d-flex align-items-center gap-3">
          <span class="text-light">
            <?= $_SESSION['user']['user_name'] ?>
          </span>

          <form action="/actions/logout.php" method="post">
            <button
              name="logout"
              class="btn btn-danger btn-sm"
            >
              Sair
            </button>
          </form>
        </div>

      <?php else : ?>

        <a href="/views/login" class="btn btn-light btn-sm">
          Entrar
        </a>

      <?php endif; ?>

    </div>
  </div>
</nav>