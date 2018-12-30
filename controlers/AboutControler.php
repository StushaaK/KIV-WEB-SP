<?php
session_start();

class AboutControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'O Konferenci',
      'keywords' => 'about, o konferenci, o nás, about us',
      'description' => 'Stránky podává informace o konferenci'
    );

  $this->view = 'about';

  }

}
?>
