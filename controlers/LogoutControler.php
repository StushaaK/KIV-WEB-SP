<?php
session_start();

class LogoutControler extends Controler {

  public function process($parameters) {

    session_destroy();

    $this->redirect('landing');
  }

}

 ?>
