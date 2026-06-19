<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Testimonials.php';
require_once ROOT_PATH . '/classes/Session.php';

$testimonials = new Testimonials();
$session = new Session();

if (isset($_POST['approve_testimonial'])) {
  $testimonial_id = $_POST['testimonial_id'];

  $testimonials->id = $testimonial_id;

  $testimonials->approve();
}
