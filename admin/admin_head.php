  <?php
  include "admin_functions.php";
  ?>
  <html>
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src=" <?php echo $_SERVER['DOCUMENT_ROOT'] . '/monitorizare-vot-votanti/includes/js/bootstrap.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/monitorizare-vot-votanti/includes/js/bootstrap-filestyle.min.js';?>">
    </script>

  </head>
    <title>Administrare::Monitorizare vot </title>
  </head>
    <body>
    <h1>Salut, <?php echo $_SESSION['login_user']; ?></h1>
