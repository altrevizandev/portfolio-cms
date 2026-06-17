<?php
  if (isset($_SESSION["success"])):
?>

  <div class="mt-3 alert alert-success alert-dismissible fade show w-100" role="alert">
    <?= $_SESSION["success"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
  </div>

<?php
  unset($_SESSION["success"]);
  endif;
?>