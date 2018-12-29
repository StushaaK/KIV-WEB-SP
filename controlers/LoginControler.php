<?php

class LoginControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Přihlášení',
      'keywords' => 'přihlášení, email, formulář, username, jmeno, heslo, password',
      'description' => 'Přihlašovací formulář Konference'
    );

  $this->view = 'login';

  }

}
 ?>
