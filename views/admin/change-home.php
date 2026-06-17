<?php

require_once '../../config/Constants.php';

require_once ROOT_PATH . 'classes/Stacks.php';
require_once ROOT_PATH . 'classes/SectionOne.php';
require_once ROOT_PATH . 'classes/SectionTwo.php';
require_once ROOT_PATH . 'classes/SectionThree.php';

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
      Admin - Mudar Home - André Lucas Trevizan Portfolio
    </title>
  </head>
  <body>
    <?php include('../../views/layouts/navbar.php') ?>
    <div class="container py-3 d-flex flex-column gap-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/views/admin">Admin</a></li>
          <li class="breadcrumb-item" aria-current="page">
            Editando homepage
          </li>
        </ol>
      </nav>
      <h3>Aqui você pode alterar as informações da homepage</h3>
      <?php include('../layouts/message.php') ?>
      <?php include('../layouts/success.php') ?>
      <?php include('../layouts/error.php') ?>
      <div>
        <?php if ($sectionOneData != null) { ?>
          <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropSession1" aria-controls="staticBackdropSession1">
            Editar essa seção
          </button>
        <?php } else { ?>
          <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropCreateSession1" aria-controls="staticBackdropCreateSession1">
            Criar
          </button>
        <?php } ?>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropCreateSession1" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Criando seção 1</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form
                action="/actions/createSectionOne.php"
                method="post"
                enctype="multipart/form-data"
              >
                <div class="border-bottom">
                  <h6 class="mb-3">Cabeçalho</h6>
                  <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" class="form-control" aria-label="file example" required name="image" accept="image/*" id="so-create-image-input">
                    <img src="#" class="img-thumbnail" alt="Imagem sessão 1" style="width: 25rem;" id="so-create-image-preview">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input class="form-control" type="text" name="name" placeholder="Entre com seu nome">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <input class="form-control" type="text" name="address" placeholder="Entre com seu endereço">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Data de Nascimento</label>
                    <input class="form-control" type="date" name="birth_date">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Cargo</label>
                    <input class="form-control" type="text" name="position" placeholder="Entre com seu cargo">
                  </div>
                </div>
                <div class="border-bottom">
                  <h6 class="my-3">Sobre mim</h6>
                  <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" type="text" name="about_me" placeholder="Entre com uma descrição sobre você"></textarea>
                  </div>
                </div>
                <div class="border-bottom">
                  <h6 class="my-3">Estudo e aprendizado</h6>
                  <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" type="text" name="studies" placeholder="Entre com uma descrição sobre seus estudos e aprendizados"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <h6 class="my-3">Stacks principais</h6>
                  <div class="d-flex gap-3">
                    <?php if (count($stacks) > 0) { ?>
                      <div class="d-flex gap-2 justify-content-around flex-wrap">
                        <?php foreach( $stacks as $stack ) { ?>
                          <div class="form-check d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" 
                            value="<?= $stack['id'] ?>" name="stacks[]" id="check_<?= $stack['name'] ?>">
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
                <div>
                  <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                    <button name="create_section_one" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                    <?php } else { ?>
                    <button name="create_section_one" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                  <?php } ?>
                </div>
              </form>
            </div>
          </div>
        <?php if ($sectionOneData != null) : ?>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropSession1" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Editando seção #1</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form
                action="/actions/updateSectionOne.php"
                method="post"
                enctype="multipart/form-data"
                class="d-flex flex-column gap-3"
              >
                <input type="hidden" name="section_id" value="<?= $sectionOneData['id'] ?>">
                <div class="border-bottom">
                  <h6 class="mb-3">Cabeçalho</h6>
                  <div class="mb-3 d-flex flex-column gap-3">
                    <div clas="d-flex gap-2 align-items-center">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="so_one_change_img"
                        id="so-change-img-check-input"
                      >
                      <label class="form-check-label" for="so-change-img-check-input">Quer mudar a imagem?</label>
                    </div>
                    <div id="so-change-img-area">
                      <input type="hidden" name="old_image" value="<?= $sectionOneData['image'] ?>" id="so-change-old-image">
                      <label class="form-label">Imagem</label>
                      <input type="file" class="form-control" aria-label="file example" name="new_image" accept="image/*" id="so-change-image-input">
                    </div>
                    <div>
                      <img src="<?= $sectionOneData['image'] ?>" class="img-thumbnail" alt="Image" style="width: 25rem;" id="so-change-image-preview">
                      <button id="so-change-cancel-change-image-btn" type="button" class="btn btn-link btn-sm text-danger">Cancelar troca de imagem</button>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input class="form-control" type="text" name="name" placeholder="Entre com seu nome" value="<?= $sectionOneData['name'] ?>">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <input class="form-control" type="text" name="address" placeholder="Entre com seu endereço" value="<?= $sectionOneData['address'] ?>">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Data de Nascimento</label>
                    <input class="form-control" type="date" name="birth_date" value="<?= date('Y-m-d', strtotime($sectionOneData['birth_date'])) ?>">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Cargo</label>
                    <input class="form-control" type="text" name="position" placeholder="Entre com seu cargo" value="<?= $sectionOneData['position'] ?>">
                  </div>
                </div>
                <div class="border-bottom">
                  <h6>Sobre mim</h6>
                  <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" type="text" name="about_me" placeholder="Entre com uma descrição sobre você"><?= $sectionOneData['about'] ?></textarea>
                  </div>
                </div>
                <div class="border-bottom">
                  <h6>Estudo e aprendizado</h6>
                  <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" type="text" name="studies" placeholder="Entre com uma descrição sobre seus estudos e aprendizados"><?= $sectionOneData['studies'] ?></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <h6>Stacks Principais</h6>
                  <label class="form-label">Alterar as stacks que você usou para criar esse projeto</label>
                  <div class="d-flex gap-3">
                    <?php if (count($stacks) > 0) { ?>
                      <div class="d-flex gap-2 justify-content-around flex-wrap">
                        <?php foreach( $stacks as $stack ) { ?>
                          <div class="form-check d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" 
                            value="<?= $stack['id'] ?>" name="stacks[]" id="check_<?= $stack['name'] ?>" <?= in_array($stack['id'], array_column($sectionOneData['stacks'], 'stack_id')) ? "checked" : "" ?>>
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
                <div>
                  <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                    <button
                      class="btn btn-primary btn-sm"
                      type="submit"
                      name="update_section_one"
                    >
                      Salvar
                    </button>
                  <?php } else { ?>
                    <button
                      class="btn btn-primary btn-sm"
                      type="submit"
                      name="update_section_one"
                      disabled
                    >
                      Salvar
                    </button>

                  <?php } ?>
                </div>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <?php if ($sectionOneData != null) { ?>
        <div class="
          d-flex
          flex-column
          flex-xl-row
          justify-content-center
          gap-5
          mb-5
        ">
          <img
            src="<?= $sectionOneData['image'] ?>"
            class="img-fluid rounded-4"
            style="box-shadow: 0 0 40px rgba(0,0,0,.3); max-width: 500px; width:100%;"
            alt="Andre"
          />
          <div>
            <div
              class="
              d-flex
              flex-column
              flex-md-row
              gap-2
            ">
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
      <div
        class="
          d-flex
          flex-column
          flex-xl-row
          gap-5
        "
      >
        <div>
          <div class="d-flex align-items-center gap-2 mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#editSectionTwoOffcanvas" aria-controls="editSectionTwoOffcanvas">
              Editar essa seção
            </button>
            <?php if ($sectionTwoData['section_id'] == 0) : ?>
              <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createSectionTwoOffcanvas" aria-controls="createSectionTwoOffcanvas">
                Criar seção
              </button>
            <?php endif; ?>
          </div>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="createSectionTwoOffcanvas" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Criando Seção #2</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form
                action="/actions/createSectionTwo.php"
                enctype="multipart/form-data"
                method="post"
              >
                <div class="mb-3">
                  <label class="form-label">Imagem da seção</label>
                  <input type="file" class="form-control" aria-label="file example" required name="image" accept="image/*" id="st-create-image-input">
                  <img src="#" class="img-thumbnail mt-3" alt="Imagem sessão 2" style="width: 25rem;" id="st-create-image-preview">
                </div>
                <button name="create_section_two" class="btn btn-primary btn-sm" type="submit">Salvar</button>
              </form>
            </div>
          </div>
          <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="editSectionTwoOffcanvas" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Editando Seção #2</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <h6 class="mb-3">Imagem da seção</h6>
                <form
                  action="/actions/updateSectionTwoImage.php"
                  enctype="multipart/form-data"
                  method="post"
                >
                  <input type="hidden" name="section_id" value="<?= $sectionTwoData['section_id'] ?>">
                  <div class="mb-3 d-flex flex-column gap-3">
                    <div clas="d-flex gap-2 align-items-center">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="st_change_img"
                        id="st-change-img-check-input"
                      >
                      <label class="form-check-label" for="st-change-img-check-input">Quer mudar a imagem?</label>
                    </div>
                    <div id="st-change-img-area">
                      <input type="hidden" name="old_image" value="<?= $sectionTwoData['image'] ?>" id="st-change-old-image">
                      <label class="form-label">Imagem</label>
                      <input type="file" class="form-control" aria-label="file example" name="image" accept="image/*" id="st-change-image-input">
                    </div>
                    <div>
                      <img src="<?= $sectionTwoData['image'] ?>" class="img-thumbnail" alt="Image" style="width: 25rem;" id="st-change-image-preview">
                      <button id="st-change-cancel-change-image-btn" type="button" class="btn btn-link btn-sm text-danger">Cancelar troca de imagem</button>
                    </div>
                  </div>
                  <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                    <button name="update_section_two" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                  <?php } else { ?>
                    <button name="update_section_two" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                  <?php } ?>
                </form>
            </div>
          </div>
          <div class="d-flex flex-column gap-3">
            <div class="d-flex align-items-center gap-2">
              <h3>Experiencia Profissional</h3>
              <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#createExpProfessionalOffcanvas" aria-controls="createExpProfessionalOffcanvas">
                Criar
              </button>
              <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditProExp" aria-controls="offcanvasEditProExp">
                Editar
              </button>
              <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="createExpProfessionalOffcanvas" aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header border-bottom">
                  <h5 class="offcanvas-title" id="staticBackdropLabel">Criando Experiencia Profissional</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <form
                    action="/actions/createProfessionalExperience.php"
                    method="post"
                  >
                    <input type="hidden" name="section_id" value="<?= $sectionTwoData['section_id'] ?>">
                    <div class="mb-3">
                      <label class="form-label">Empresa ou local de trabalho</label>
                      <input class="form-control" type="text" name="company" placeholder="Entre com o nome do lugar onde você trabalhou">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Descrição</label>
                      <textarea class="form-control" type="text" name="description" placeholder="Entre com uma descrição sobre o que você fazia"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                      <input class="form-check-input" type="checkbox" id="st-create-actual-job-check-input" name="actual_job">
                      <label class="form-check-label" for="st-create-actual-job-check-input">
                        Seu emprego atual?
                      </label>
                    </div>
                    <div class="mb-3" id="st-create-since-date-area">
                      <label class="form-label">Desde</label>
                      <input class="form-control" type="date" name="since"/>
                    </div>
                    <div class="d-flex align-items-center justify-content-around gap-3" id="st-create-start-end-dates-area">
                      <div class="mb-3">
                        <label class="form-label">De</label>
                        <input class="form-control" type="date" name="start_date"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Ate</label>
                        <input class="form-control" type="date" name="final_date"/>
                      </div>
                    </div>
                    <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                      <button name="create_pro_exp" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                    <?php } else { ?>
                      <button name="create_pro_exp" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </div>
            <?php if (count($sectionTwoData['experiences']) > 0) { ?>
              <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvasEditProExp" aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header border-bottom">
                  <h5 class="offcanvas-title" id="staticBackdropLabel">Editando seção #2</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <h6 class="mb-3">Experiencias Profissionais</h6>
                  <?php foreach($sectionTwoData['experiences'] as $experience) : ?>
                    <div class="accordion" id="accordion<?= $experience['id'] ?>">
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $experience['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?= $experience['id'] ?>">
                            <?= $experience['company'] ?> 
                          </button>
                        </h2>
                        <div id="collapseOne<?= $experience['id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordion<?= $experience['id'] ?>">
                          <div class="accordion-body">
                            <form
                              action="/actions/updateProfessionalExp.php"
                              method="post"
                            >
                              <input type="hidden" name="exp_id" value="<?= $experience['id'] ?>">
                              <div class="mb-3">
                                <label class="form-label">Empresa ou Local de trabalho</label>
                                <input class="form-control" type="text" name="company" placeholder="Entre com o nome do lugar onde você trabalhou" value="<?= $experience['company'] ?>">
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control" type="text" name="description" placeholder="Entre com uma descrição sobre o que você fazia"><?= $experience['description'] ?></textarea>
                              </div>
                              <div class="mb-3 form-check">
                                <input class="form-check-input actual-job-checkbox" type="checkbox" id="st-change-actual-job-check-<?= $experience['id'] ?>" name="actual_job" <?= $experience['actual_job'] == 't' ? "checked" : "" ?> data-experience-id="<?= $experience['id'] ?>" >
                                <label class="form-check-label" for="st-change-actual-job-check-<?= $experience['id'] ?>">
                                  Seu emprego atual?
                                </label>
                              </div>
                              <div class="mb-3 st-since-area" id="st-change-since-date-area-<?= $experience['id'] ?>" data-experience-id="<?= $experience['id'] ?>">
                                <label class="form-label st-since-date">Desde</label>
                                <input class="form-control" type="date" name="since" value="<?= $experience['actual_job'] == 't' ? date('Y-m-d', strtotime($experience['start_date'])) : "" ?>"/>
                              </div>
                              <div class="st-start-end-dates-area" id="st-change-start-end-dates-area-<?= $experience['id'] ?>" data-experience-id="<?= $experience['id'] ?>">
                                <div class="mb-3">
                                  <label class="form-label">De</label>
                                  <input class="form-control st-start-date" type="date" name="start_date" id="st-start-date-<?= $experience['id'] ?>" value="<?= date('Y-m-d', strtotime($experience['start_date'])) ?>" />
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Ate</label>
                                  <input class="form-control st-end-date" type="date" name="final_date" id="st-end-date-<?= $experience['id'] ?>" value="<?= date('Y-m-d', strtotime($experience['final_date'])) ?>" />
                                </div>
                              </div>
                              <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                                <button name="update_pro_exp" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                              <?php } else { ?>
                                <button name="update_pro_exp" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                              <?php } ?>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div>
                <?php foreach($sectionTwoData['experiences'] as $experience) : ?>
                  <div
                    class="
                      d-flex
                      flex-column
                      flex-md-row
                      justify-content-between
                      align-items-start
                      align-items-md-center
                      gap-2
                      mb-2
                    "
                  >
                    <div
                      class="
                        d-flex
                        flex-column
                        flex-md-row
                        gap-2
                        align-items-start
                        align-items-md-center
                      "
                    >
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
                    <div>
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeExpPro<?= $experience['id'] ?>">
                        Remover
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="removeExpPro<?= $experience['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="removeExpPro<?= $experience['id'] ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="removeExpPro<?= $experience['id'] ?>">Deletar essa experiencia profissional?</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Deseja mesmo deletar a experiencia profissional com <?= $experience['company'] ?>?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              <form action="/actions/deleteProExp.php" method="post">
                                <input name="exp_id" type="text" hidden value="<?= $experience['id'] ?>">
                                <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                                  <button type="submit" name="delete_pro_exp" class="btn btn-danger">Sim, quero remover</button>
                                <?php } else { ?>
                                  <button type="submit" name="delete_pro_exp" class="btn btn-danger" disabled>Sim, quero remover</button>
                                <?php } ?>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p style="text-align: justify;"><?= $experience['description'] ?></p>
                <?php endforeach; ?>
              </div>
            <?php } else { ?>
              <div>
                <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="createExpProfessionalOffcanvas" aria-labelledby="staticBackdropLabel">
                  <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="staticBackdropLabel">Criando Experiencia Profissional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <form
                      action="/actions/createProfessionalExperience.php"
                      enctype="multipart/form-data"
                      method="post"
                    >
                      <div class="mb-3">
                        <label class="form-label">Imagem da seção</label>
                        <input type="file" class="form-control" aria-label="file example" required name="image" accept="image/*" id="st-create-image-input">
                        <img src="#" class="img-thumbnail mt-3" alt="Imagem sessão 2" style="width: 25rem;" id="st-create-image-preview">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Empresa ou local de trabalho</label>
                        <input class="form-control" type="text" name="company" placeholder="Entre com o nome do lugar onde você trabalhou">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" type="text" name="description" placeholder="Entre com uma descrição sobre o que você fazia"></textarea>
                      </div>
                      <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="st-create-actual-job-check-input" name="actual_job">
                        <label class="form-check-label" for="st-create-actual-job-check-input">
                          Seu emprego atual?
                        </label>
                      </div>
                      <div class="mb-3" id="st-create-since-date-area">
                        <label class="form-label">Desde</label>
                        <input class="form-control" type="date" name="since"/>
                      </div>
                      <div class="d-flex align-items-center justify-content-around gap-3" id="st-create-start-end-dates-area">
                        <div class="mb-3">
                          <label class="form-label">De</label>
                          <input class="form-control" type="date" name="start_date"/>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Ate</label>
                          <input class="form-control" type="date" name="final_date"/>
                        </div>
                      </div>
                      <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                        <button name="create_pro_exp" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                      <?php } else { ?>
                        <button name="create_pro_exp" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                      <?php } ?>
                    </form>
                  </div>
                </div>
                <h5>As experiencias profissionais que você cadastrar vão aparecer aqui</h5>
              </div>
            <?php } ?>
          </div>
        </div>
        <?php if ($sectionTwoData['image']) : ?>
          <img
            src="<?= $sectionTwoData['image'] ?>"
            class="img-fluid rounded-4"
            style="box-shadow: 0 0 40px rgba(0,0,0,.3); width: auto; max-height: 700px;"
            alt="Imagem da seção 2"
          />
        <?php endif; ?>
      </div>
      <hr>
      <div>
        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropSession3" aria-controls="staticBackdropSession3">
          Editar essa seção
        </button>
        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#createFormationOffcanvas" aria-controls="createFormationOffcanvas">
          Criar formação
        </button>
        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropSession3" aria-labelledby="staticBackdropLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Editando seção #3</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-3">Formações</h6>
            <?php foreach($formations as $formation) : ?>
              <div class="accordion" id="accordion<?= $formation['id'] ?>">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $formation['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?= $formation['id'] ?>">
                      <?= $formation['course'] ?> 
                    </button>
                  </h2>
                  <div id="collapseOne<?= $formation['id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordion<?= $formation['id'] ?>">
                    <div class="accordion-body">
                      <form action="/actions/updateFormation.php" method="post">
                        <input type="hidden" name="formation_id" value="<?= $formation['id'] ?>">
                        <div class="mb-3">
                          <label class="form-label">Instituição</label>
                          <input class="form-control" type="text" name="institution" placeholder="Entre com o nome da instituição de ensino" value="<?= $formation['institution'] ?>">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Curso</label>
                          <input class="form-control" type="text" name="course" placeholder="Entre com uma descrição sobre o que você fazia" value="<?= $formation['course'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Descrição</label>
                          <textarea class="form-control" type="text" name="description" placeholder="Entre com uma descrição"><?= $formation['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Situação</label>
                          <select class="form-select" aria-label="Default select example" required name="situation" value="<?= $formation['situation'] ?>">
                            <option>Qual a situação dessa formação?</option>
                            <option
                              value="formado"
                              <?= $formation['situation'] === 'formado' ? 'selected' : '' ?>
                            >
                              Formado
                            </option>
                            <option
                              value="nao-finalizado"
                              <?= $formation['situation'] === 'nao-finalizado' ? 'selected' : '' ?>  
                            >
                              Não finalizado
                            </option>
                            <option
                              value="em-andamento"
                              <?= $formation['situation'] === 'em-andamento' ? 'selected' : '' ?>
                            >
                              Em andamento
                            </option>
                          </select>
                        </div>
                        <div class="mb-3 form-check">
                          <input class="form-check-input s3-still-studying-check" data-formation-id="<?= $formation['id'] ?>" type="checkbox" id="s3-change-check-still-studying-<?= $formation['id'] ?>" name="still_studying" <?= $formation['still_studying'] == 't' ? "checked" : "" ?>>
                          <label class="form-check-label" for="s3-change-check-still-studying-<?= $formation['id'] ?>">
                            Ainda cursando?
                          </label>
                        </div>
                        <div class="mb-3 s3-change-since-area" id="s3-change-since-area" data-formation-id="<?= $formation['id'] ?>">
                          <label class="form-label">Inicio</label>
                          <input class="form-control s3-change-since-input" type="date" name="since" value="<?= date('Y-m-d', strtotime($formation['start_date'])) ?>"/>
                        </div>
                        <div class="s3-change-start-end-date-div" id="s3-change-dates-area" data-formation-id="<?= $formation['id'] ?>">
                          <div class="mb-3">
                            <label class="form-label">De</label>
                            <input class="form-control" type="date" name="start_date" value="<?= date('Y-m-d', strtotime($formation['start_date'])) ?>"/>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Ate</label>
                            <input class="form-control" type="date" name="final_date" value="<?= date('Y-m-d', strtotime($formation['final_date'])) ?>"/>
                          </div>
                        </div>
                        <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                          <button name="update-formation" class="btn btn-primary btn-sm" type="submit">Salvar</button>
                        <?php } else { ?>
                          <button name="update-formation" class="btn btn-primary btn-sm" type="submit" disabled>Salvar</button>
                        <?php } ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="createFormationOffcanvas" aria-labelledby="staticBackdropLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Criando Nova Formação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form action="/actions/createFormation.php" method="post">
              <div class="mb-3">
                <label class="form-label">Instituição</label>
                <input class="form-control" type="text" name="institution" placeholder="Entre com o nome da instituição de ensino">
              </div>
              <div class="mb-3">
                <label class="form-label">Curso</label>
                <input class="form-control" type="text" name="course" placeholder="Engenharia de..."/>
              </div>
              <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" type="text" name="description" placeholder="Entre com uma descrição"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Situação</label>
                <select class="form-select" aria-label="Default select example" required name="situation">
                  <option selected>Qual a situação dessa formação?</option>
                  <option value="formado">Formado</option>
                  <option value="nao-finalizado">Não finalizado</option>
                  <option value="em-andamento">Em andamento</option>
                </select>
              </div>
              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" id="s3-create-check-still-studying" name="still_studying">
                <label class="form-check-label" for="s3-create-check-still-studying">
                  Ainda cursando?
                </label>
              </div>
              <div class="mb-3" id="s3-create-since-area">
                <label class="form-label">Inicio</label>
                <input class="form-control" type="date" name="since"/>
              </div>
              <div class="d-flex align-items-center justify-content-around gap-3" id="s3-create-dates-area">
                <div class="mb-3">
                  <label class="form-label">De</label>
                  <input class="form-control" type="date" name="start_date"/>
                </div>
                <div class="mb-3">
                  <label class="form-label">Ate</label>
                  <input class="form-control" type="date" name="final_date"/>
                </div>
              </div>
              <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                <button class="btn btn-primary btn-sm" type="submit" name="create-formation">Salvar</button>
              <?php } else { ?>
                <button class="btn btn-primary btn-sm" type="submit" name="create-formation" disabled>Salvar</button>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
      <div class="d-flex flex-column align-items-center">
        <h3 class="mb-5">Formação</h3>
        <?php if (count($formations) > 0) { ?>
          <?php foreach($formations as $formation) : ?>
            <div class="d-fex flex-column align-items-center justify-content-center mb-5 w-50">
              <div
                class="
                d-flex
                flex-column
                flex-md-row
                justify-content-center
                align-items-center
                gap-2
              ">
                <h5><?= $formation['course'] ?> - <?= $formation['institution'] ?> (<?= date('m/Y', strtotime($formation['start_date'])); ?><?= $formation['still_studying'] == 't' ? "" : '- ' . date('m/Y', strtotime($formation['final_date'])); ?>)</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeFormation<?= $formation['id'] ?>">
                  Remover
                </button>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="removeFormation<?= $formation['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="removeFormation<?= $formation['id'] ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="removeFormation<?= $formation['id'] ?>">Deletar essa formação?</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Deseja mesmo deletar a formação <?= $formation['course'] ?>?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <form action="/actions/deleteFormation.php" method="post">
                        <input name="formation_id" type="text" hidden value="<?= $formation['id'] ?>">
                        <?php if ($_SESSION['user']['user_role'] == "admin") { ?>
                          <button type="submit" name="delete-formation" class="btn btn-danger">Sim, quero remover</button>
                        <?php } else { ?>
                          <button type="submit" name="delete-formation" class="btn btn-danger" disabled>Sim, quero remover</button>
                        <?php } ?>
                      </form>
                    </div>
                  </div>
                </div>
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
    <script src="./index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>