<?php
session_start();

class RegisterControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Registrace',
      'keywords' => 'registrace, email, formulář, username, jmeno, heslo, password',
      'description' => 'Registrační formulář Konference'
    );

    $this->view = 'register';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //jestli se hesla shodují
    if ($_POST['password'] == $_POST['confirmpassword']) {

      $userArray = array($_POST['username'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), 'img/'.$_FILES['avatar']['name'], 0, 0);

      if(!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])){
        $userArray[3] = 'img/avatar_placeholder.png';
        $registrationManager = new RegistrationManager();
        $registrationManager->registerUser($userArray);

        $_SESSION['message'] = "Registration successful. Added $userArray[0] to the database";
      }
      else {
      //ověření zda je soubor obrázek
      if (preg_match("!image!", $_FILES['avatar']['type'])) {

        //zkopírovat obrázek do img složky
        if(copy($_FILES['avatar']['tmp_name'], $userArray[3])){

          $registrationManager = new RegistrationManager();
          $registrationManager->registerUser($userArray);

          $_SESSION['message'] = "Registration successful. Added $userArray[0] to the database";

          }

          else {
            $_SESSION['message'] = "File upload failed!";
          }
        }
        else {
          $_SESSION['message'] = "Please only upload GIF, JPG or PNG images!";
          }
        }
      }
      else {
        $_SESSION['message'] = "Passwords do not match!";
      }
    }





  }

}
 ?>
