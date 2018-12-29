<?php

abstract class Controler
{

        protected $data = array();
        protected $view = "";
        protected $header = array('title' => '', 'keywords' => '', 'description' => '');



  abstract function process($parametry);


  public function getView()
  {
          if ($this->view)
          {
                  extract($this->data);
                  require("views/" . $this->view . ".phtml");
          }
  }

  public function redirect($url)
  {
          header("Location: /$url");
          header("Connection: close");
          exit;
  }

}
 ?>
