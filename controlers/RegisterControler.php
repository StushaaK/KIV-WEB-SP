<?php

class RegisterControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Registrace',
      'keywords' => 'registrace, email, formulář, username, jmeno, heslo, password',
      'description' => 'Registrační formulář Konference'
    );

  $registrationManager = new RegistrationManager();
  echo $registrationManager->registerUser();

  $this->view = 'register';

  }

}
 ?>
