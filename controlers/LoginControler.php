<?php
session_start();

class LoginControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Přihlášení',
      'keywords' => 'přihlášení, email, formulář, username, jmeno, heslo, password',
      'description' => 'Přihlašovací formulář Konference'
    );

  $this->view = 'login';



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userArray = array($_POST['email'], $_POST['password']);
    $loginManager = new LoginManager();
    if ($loginManager->checkEmail(array($userArray[0])) == 0) {
      $_SESSION['message'] = "Uživatel s tímto e-mailem není v databázi!";
    }
    else {
      $user = $loginManager->getUser(array($userArray[0]));

      if (password_verify($_POST['password'], $user['password'])) {
          $_SESSION['message'] = "User successfuly logged in!";
          $_SESSION['userID'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['avatar'] = $user['avatar'];

          if ($user['admin']==true)
          {
            $_SESSION['accountType'] = "administrátor";
          }
          else if ($user['reviewer']==true) {
            $_SESSION['accountType'] = "recenzent";
          }
          else {
            $_SESSION['accountType'] = "běžný uživatel";
          }

          $_SESSION['logged_in'] = true;
          $this->redirect(landing);

      }

      else {
        $_SESSION['message'] = "Špatné heslo!";
      }
    }
  }
}


}


 ?>
