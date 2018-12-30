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

        $_SESSION['message'] = "Registrace byla úspěšná. Uživatel $userArray[0] přidán do databáze";
      }
      else {
      //ověření zda je soubor obrázek
      if (preg_match("!image!", $_FILES['avatar']['type'])) {

        //zkopírovat obrázek do img složky
        if(copy($_FILES['avatar']['tmp_name'], $userArray[3])){

          $registrationManager = new RegistrationManager();
          $registrationManager->registerUser($userArray);

          $_SESSION['message'] = "Registrace byla úspěšná. Uživatel $userArray[0] přidán do databáze";

          }

          else {
            $_SESSION['message'] = "Nepovedlo se nahrát soubor!";
          }
        }
        else {
          $_SESSION['message'] = "Prosím nahrávejte pouze obrázky ve formátu GIF, JPG nebo PNG!";
          }
        }
      }
      else {
        $_SESSION['message'] = "Hesla se neshodují!";
      }
    }





  }

}
 ?>
