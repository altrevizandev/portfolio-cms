<?php
  if (isset($_SESSION["error"])):
?>

  <div class="mt-3 alert alert-danger alert-dismissible fade show w-100" role="alert">
    <?= $_SESSION["error"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
  </div>

<?php
  unset($_SESSION["error"]);
  endif;
?>