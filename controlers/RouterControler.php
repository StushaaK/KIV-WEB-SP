<?php


class RouterControler extends Controler
{

  protected $controler;

  public function process($parameters) {
    $parsedURL = $this->parseURL($parameters[0]);

    if (empty($parsedURL[0])){
      $this->redirect('landing');
    }

    //Získání nůzvu třídy kontroleru
    $controlerClass = $this->getControlerName(array_shift($parsedURL)) . 'Controler';

    if (file_exists('controlers/' . $controlerClass . '.php')){
      $this->controler = new $controlerClass;
    }
    else {
      $this->redirect('error');
    }
    $this->controler->process($parsedURL);

    $this->data['title'] = $this->controler->header['title'];
    $this->data['description'] = $this->controler->header['description'];
    $this->data['keywords'] = $this->controler->header['keywords'];

    if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in']) == true) {
    $this->view = 'navigationLogged';
    }

    else if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in']) == false) {
    $this->view = 'navigation';
    }

    else {
      $this->view = 'navigation';
    }

  }


  private function parseURL($url)
  {
    $parsedURL = parse_url($url);
    $parsedURL["path"] = ltrim($parsedURL["path"], "/"); //Oříznout levé lomítko
    $parsedURL["path"] = trim($parsedURL["path"]);

    $explodedURL = explode("/", $parsedURL["path"]);

    return $explodedURL;
  }

  //Získání nůzvu kontroleru
  private function getControlerName($text)
  {
    $dashReplace = str_replace('-', ' ',$text);
    $dashReplace = ucwords($dashReplace);
    $dashReplace = str_replace(' ', '', $dashReplace);

    return $dashReplace;

  }

}



 ?>
