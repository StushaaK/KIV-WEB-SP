<?php

class RegistrationManager
{

  public function registerUser()
  {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jestli se hesla shodují
  if ($_POST['password'] == $_POST['confirmpassword']) {

    $userArray = array($_POST['username'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), 'img/'.$_FILES['avatar']['name'], 0, 0);

    //ověření zda je soubor obrázek
    if (preg_match("!image!", $_FILES['avatar']['type'])) {

      //zkopírovat obrázek do img složky
      if(copy($_FILES['avatar']['tmp_name'], $userArray[3])){

        $_SESSION['username'] = $userArray[0];
        $_SESSION['avatar'] = $userArray[3];

        return Db::insertRow('
          INSERT INTO users (username, email, password, avatar, admin, reviewer) VALUES (?)
        ', $userArray);

        }
      }
    }
  }
}
}

 ?>
