<?php
  require_once '../../config/Constants.php';
  require_once ROOT_PATH . 'classes/Projects.php';
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

  if (!isset($_GET['project_id'])) {
    header('Location: /views/projects');
    exit;
  }

  $project_id = $_GET['project_id'];
  $prj = new Project();

  $projectDetails = $prj->findById($project_id);
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
      Edição de projeto - André Lucas Trevizan Portfolio
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
            Editando projeto
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
        <h3 class="mb-0">Editando projeto</h3>

        <a
          href="/views/projects"
          class="btn btn-danger btn-sm"
        >
          Cancelar e voltar
        </a>
      </div>
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/error.php') ?>
      <?php include('../layouts/message.php') ?>
      <form
        action="/actions/updateProject.php"
        method="post"
        enctype="multipart/form-data"
        id="form_update"
      >
        <input hidden type="text" name="prj_id" value="<?= $projectDetails["id"] ?>">
        <input hidden type="text" name="prj_old_thumbnail" value="<?= $projectDetails["prj_thumbnail"] ?>">
        <div class="mb-3 form-check">
          <input class="form-check-input" type="checkbox" id="checkPrjStatus" name="prj_status" <?= $projectDetails["prj_status"] == 't' ? "checked" : "" ?>>
          <label class="form-check-label" for="checkPrjStatus">
            Você quer exibir esse projeto no portfolio?
          </label>
        </div>
        <div class="mb-3">
          <label class="form-label">Título</label>
          <input type="text" name="prj_title" class="form-control" placeholder="Entre com o título do projeto" value="<?= $projectDetails["prj_title"] ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Descrição</label>
          <textarea type="text" name="prj_description" class="form-control" placeholder="Entre com a descrição do projeto" rows="5" required><?= $projectDetails["prj_description"] ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Desafio</label>
          <textarea type="text" name="prj_challenge" class="form-control" placeholder="Entre com a descrição do projeto" rows="5" required><?= $projectDetails["prj_challenge"] ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Solução</label>
          <textarea type="text" name="prj_solution" class="form-control" placeholder="Entre com a descrição do projeto" rows="5" required><?= $projectDetails["prj_solution"] ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Alterar as stacks que você usou para criar esse projeto</label>
          <div class="d-flex gap-3">
            <?php if (count($stacks) > 0) { ?>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach( $stacks as $stack ) { ?>
                  <div class="form-check d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" 
                    value="<?= $stack['id'] ?>" name="prj_stacks[]" id="check_<?= $stack['name'] ?>" <?= in_array($stack['id'], array_column($projectDetails['stacks'], 'id')) ? "checked" : "" ?>>
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
        <div class="mb-3 form-check">
          <input class="form-check-input" type="checkbox" id="checkDefault" name="prj_corporative" <?= $projectDetails["prj_corporative"] == 't' ? "checked" : "" ?>>
          <label class="form-check-label" for="checkDefault">
            Esse foi um projeto corporativo?
          </label>
        </div>
        <div class="mb-3 d-flex flex-column flex-lg-row gap-3">
          <div class="d-flex flex-column">
            <label class="form-label">Thumbnail</label>
            <img src="<?= $projectDetails['prj_thumbnail'] ?>" class="img-thumbnail w-100" alt="Thumbnail" style="max-width: 25rem;" id="prj_thumbnail">
          </div>
          <div class="d-flex flex-column gap-3 w-100">
            <div class="d-flex align-items-center gap-2">
              <input name="changing_thumbnail" class="form-check-input" type="checkbox" id="checkChangeThumb">
              <label class="form-check-label" for="checkChangeThumb">
                Quer trocar essa thumb?
              </label>
            </div>
            <input type="file" id="new_thumb" class="form-control" aria-label="file example" name="new_thumbnail" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm" id="cancel_change_thumb_btn">Cancelar</button>
          </div>
        </div>
        <div class="d-grid d-md-block">
          <?php if (isset($_SESSION['user'])) : ?>
            <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
              <button id="submit_form_btn" type="submit" name="update_project" class="btn btn-warning btn-sm">Salvar</button>
            <?php } else { ?>
              <button disabled id="submit_form_btn" type="submit" name="update_project" class="btn btn-warning btn-sm">Salvar</button>
            <?php } ?>
          <?php else : ?>
            <button disabled id="submit_form_btn" type="submit" name="update_project" class="btn btn-warning btn-sm">Salvar</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
    <script>
      const checkChangeThumbInput = document.getElementById("checkChangeThumb");
      const cancelChangeThumbBtn = document.getElementById("cancel_change_thumb_btn");
      const newThumbInput = document.getElementById("new_thumb");
      const imagePreview = document.getElementById('prj_thumbnail');

      const originalImage = imagePreview.getAttribute('src');

      newThumbInput.setAttribute("hidden", true);
      cancelChangeThumbBtn.setAttribute("hidden", true);

      checkChangeThumbInput.addEventListener('change', (e) => {
        if (checkChangeThumbInput.checked) {
          newThumbInput.removeAttribute("hidden");
          cancelChangeThumbBtn.removeAttribute("hidden");
        } else {
          newThumbInput.setAttribute("hidden", true);
          cancelChangeThumbBtn.setAttribute("hidden", true);
        }
      });

      cancelChangeThumbBtn.addEventListener('click', (e) => {
        checkChangeThumbInput.checked = false;
        newThumbInput.setAttribute("hidden", true);
        cancelChangeThumbBtn.setAttribute("hidden", true);
        imagePreview.setAttribute('src', originalImage);
        newThumbInput.value = '';
      });

      newThumbInput.addEventListener('change', (e) => {
        const fileList = e.target.files; 

        if (fileList.length > 0) {
          const firstFile = fileList[0]; 

          const objectURL = URL.createObjectURL(firstFile);

          imagePreview.src = objectURL;

          imagePreview.onload = function() {
            URL.revokeObjectURL(objectURL);
          };
        }
      });
    </script>
  </body>
</html>