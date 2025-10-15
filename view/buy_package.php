<?php
include_once dirname(__DIR__, 1) . "/user.php";
include_once dirname(__DIR__, 1) . "/utils.php";
session_start();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
$user = null;
if(isset($_SESSION["user"])){
    $user= User::findByID($_SESSION["user"]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        html {
            font-size: 14px;
        }
        @media (min-width: 768px) {
        html {
            font-size: 16px;
        }
        }

        .container {
        max-width: 960px;
        }

        .pricing-header {
        max-width: 700px;
        }

        .card-deck .card {
        width: 300px;
        }

        .border-top { border-top: 1px solid #e5e5e5; }
        .border-bottom { border-bottom: 1px solid #e5e5e5; }

        .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }

    </style>
    <title>Package</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pricing</h1>
      <p class="lead">Welcome to our Homestays and cultural exchange site! We are a team of passionate travel enthusiasts who believe that travel is not just a way to escape the routine of daily life, but also an opportunity to discover new places, connect with different cultures, and create unforgettable memories</p>
    </div>

    <div class="container">
      <div class="card-deck d-flex justify-content-evenly mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Couple</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$60 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>All the benefits of the single account for two people travelling together</li>
            </ul>
            <a href="register.php" class="btn btn-lg btn-block btn-primary">Get started</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Single</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$49 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">

              <li>Travel & Connect to 50,000+ opportunities</li>
              <li>Community Events and meet ups</li>
              <li>Travel Buddies 100k+ active travellers</li>
              <li>Reference letter Official personal reference</li>
            </ul>
            <a href="register.php" class="btn btn-lg btn-block btn-primary">Get started</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Gift membership</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Can be purchased as either a single or couple account. Choose and customise your own e-gift design and message</li>
            </ul>
            <a href="register.php" class="btn btn-lg btn-block btn-primary">Get started</a>
          </div>
        </div>
      </div>

    </div>
    <?php include_once "footer.php" ?>

</html>