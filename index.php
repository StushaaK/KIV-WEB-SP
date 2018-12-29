<?php
  mb_internal_encoding("UTF-8");

  function initialAutoload($class)
  {
          // název třídy končí řetězcem "Controler"
          if (preg_match('/Controler$/', $class))
                  require("controlers/" . $class . ".php");
          else
                  require("models/" . $class . ".php");
  }

  spl_autoload_register("initialAutoload");

  $router = new RouterControler();
  $router->process(array($_SERVER['REQUEST_URI']));
  $router->getView();

 ?>
