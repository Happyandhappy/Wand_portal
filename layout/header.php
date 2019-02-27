<?php
  require_once('ApiClient/Client.php');
  include "config.php";
  if (!isset($_SESSION['api'])){
    header("Location: login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Wand Portal</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" type="image/png" href="https://s3-us-west-2.amazonaws.com/hipaadev/images/a0C55000003Ua0QEAS.jpg"/>
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom px-5">
      <a class="navbar-brand" href="#">
        <img src="https://s3-us-west-2.amazonaws.com/hipaadev/images/a0C55000003Ua0QEAS.jpg" alt="Appular">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto d-flex align-items-center">
          <li class="nav-item">
            <a class="nav-link px-3" href="signup.php">SignUp <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3" href="leads.php">Leads</a>
          </li>
          <li class="nav-item">
<!--             <a class="nav-link pl-3 pr-0" href="https://themeforest.net/item/appular-bootstrap-admin-dashboard-template/23195676?ref=web14" target="_blank">
              <span class="btn btn-primary">Buy Now</span>
            </a> -->
          </li>
        </ul>
      </div>
    </nav>