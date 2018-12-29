<?php

class ErrorControler extends Controler {

  public function process($parameters) {
    header("HTTP/1.0 404 Not Found");

    $this->header['title'] = "Error 404";
    $this->view = 'error';
  }
  
}
 ?>
