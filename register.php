<?php
session_start();
$_SESSION['message'] = '';
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registrace</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/register.css">

  </head>
  <body>

      <div class="container col-sm-12 col-md-6 col-lg-4 col-xl-2">
          <form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <h2>Vytvořit účet</h2>
            <a href="index.php">< Zpět</a>
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="Uživatelské jméno" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Heslo" name="password" required>
            <input type="password" placeholder="Heslo znovu" name="confirmpassword" required>
            <div class="avatar"><label>Profilový obrázek: </label>
              <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
              <input type="file" name="avatar" accept="image/*">
            </div>
            Máte již účet? <a href="login.php">Přihlásit</a>
            <input type="submit" value="Registrovat" name="register" class="btn btn-block btn-primary">
          </form>
      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
