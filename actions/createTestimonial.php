<?php

require_once __DIR__ . '/../config/Constants.php';

require_once ROOT_PATH . '/classes/Testimonials.php';
require_once ROOT_PATH . '/classes/Session.php';

$testimonials = new Testimonials();
$session = new Session();

if (isset($_POST['create_testimonial'])) {
  $name = trim($_POST['name']);
  $company = trim($_POST['company']);
  $position = trim($_POST['position']);
  $description = trim($_POST['description']);

  $image = null;

  if (!empty($_FILES['image'])) {
    $filename = $_FILES['image']['name'];

    $tmpName = $_FILES['image']['tmp_name'];

    $newDestination =
      ROOT_PATH .
      '/public/images/' .
      $filename;

    move_uploaded_file(
      $tmpName,
      $newDestination
    );

    $image = '/public/images/' . $filename;
  }

  $social_link = "";

  if (isset($_POST['social_link']) && !empty($_POST['social_link'])) {
    $social_link = str_contains(trim($_POST['social_link']), 'https://') ? trim($_POST['social_link']) : 'https://'.trim($_POST['social_link']);
  }

  $testimonials->name = $name;
  $testimonials->company = $company;
  $testimonials->position = $position;
  $testimonials->social_link = $social_link;
  $testimonials->description = $description;
  $testimonials->image = $image;

  $testimonials->create();
}
