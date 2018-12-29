<?php

class LandingControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Úvodní stránka',
      'keywords' => 'home, domů, landingpage, landing, homepage, úvodní stránka',
      'description' => 'Úvodní stránka Konference'
    );

  $this->view = 'landing';

  }

}
 ?>
