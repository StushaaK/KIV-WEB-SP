<?php

class RegisterControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Registrace',
      'keywords' => 'registrace, email, formulář, username, jmeno, heslo, password',
      'description' => 'Registrační formulář Konference'
    );

  $this->view = 'register';

  }

}
 ?>
