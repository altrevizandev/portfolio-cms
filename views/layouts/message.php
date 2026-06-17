<?php
  if (isset($_SESSION["message"])):
?>

  <div class="mt-3 alert alert-warning alert-dismissible fade show w-100" role="alert">
    <?= $_SESSION["message"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
  </div>

<?php
  unset($_SESSION["message"]);
  endif;
?>