<?php
  require 'db.php';
  session_start();
 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <meta name="description" content="">
     <meta name="author" content="">

     <title>Přihlásit se</title>

     <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/login.css">

   </head>

   <body>

     <div class="container col-sm-12 col-md-6 col-lg-4 col-xl-2">
       <form class="form-signin">
         <h2 class="form-signin-heading">Vítejte zpátky</h2>
         <a href="index.php">< Zpět</a>
         <label for="inputEmail" class="sr-only">Email</label>
         <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
         <label for="inputPassword" class="sr-only">Heslo</label>
         <input type="password" id="inputPassword" class="form-control" placeholder="Heslo" required="">
         <div class="checkbox">
           <label>
             <input type="checkbox" value="remember-me"> Zapamatovat
           </label>
         </div>
          <a href="forgot.php">Zapomněli jste heslo?</a><br>
         Ještě nemáte účet? <a href="register.php">Registrovat</a>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
       </form>
     </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

   </body>
 </html>
