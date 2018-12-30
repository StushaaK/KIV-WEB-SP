<?php
session_start();

class ProfileControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Profil',
      'keywords' => 'profil, profile, avatar, user',
      'description' => 'Stránka s přihlášeného uživatele'
    );


  if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in']))
  {
    $this->view = 'profile';
  }
  else
  {
    $this->redirect('landing');
  }


  }

}
 ?>
