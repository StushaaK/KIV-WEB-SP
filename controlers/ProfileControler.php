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





    //Obsah podle druhu účtu
    /*

    if ($_SESSION['accountType']=="administrátor") $this->data['text']="Administrátor test";

    else if ($_SESSION['accountType']=="recenzent") $this->data['text']="Recenzent test";

    else $this->data['text']="Tady nebude vůbec nic";

    */
    $_SESSION['message']='';
    if($_SESSION['accountType']=="administrátor") {
      $profileManager = new ProfileManager();
      $this->data['users']=$profileManager->getAllUsers($_SESSION['userID']);
      $this->data['articles']=$profileManager->getAllArticles();


      if(isset($_GET['deleteUser'])) {

        $profileManager->deleteAccount($_GET['deleteUser']);

        $this->redirect('profile');
      }

      if(isset($_GET['promote'])) {
        $_SESSION['message'] = "Uživateli s id" .$_GET['promote']. "byl přidělen/odebrán status recenzenta";
        $profileManager->changeReviewerStatus($_GET['promote']);

        $this->redirect('profile');
      }

      if (isset($_GET['publish'])) {
        $_SESSION['message'] = "Stav publikovaná příspěvku id" .$_GET['publish']. "byl změněn";
        $profileManager->changePublishedStatus($_GET['publish']);

        $this->redirect('profile');
      }

      $this->view = 'adminDashboard';

    }

    //Pokud se nejedná o administrátora
    else {
      //Všechny příspěvky, které psal uživatel
      $profileManager = new ProfileManager();
      $this->data['articles']=$profileManager->getAllCreatedArticles($_SESSION['userID']);

      $this->view = 'profile';
    }


    if(isset($_GET['deleteID'])) {
      $_SESSION['message'] = "Bylo smazáno ".$profileManager->deleteArticle($_GET['deleteID'])." položek";
      $this->redirect('profile');
    }

    if(isset($_GET['newArticle'])) {
      $this->view = 'newArticle';

      $this->header = array (
        'title' => 'Profil - Vytvořit příspěvek',
        'keywords' => 'profil, profile, avatar, user, add, article, vytvořit, příspěvek',
        'description' => 'Vložit nový příspěvek');

    }

    if(isset($_POST['addArticle']))
    {
      $articleArray = array($_SESSION['userID'], $_POST['title'], $_POST['authors'], $_POST['abstract'], 'pdf/'.$_FILES['pdf']['name'], 0);

      if(copy($_FILES['pdf']['tmp_name'], $articleArray[4])){

        $profileManager->insertArticle($articleArray);
        $this->redirect('profile');
      }

      else {
         $_SESSION['message'] = 'Nepodařilo se vloži PDF soubor!';
      }


    }

    if(isset($_POST['logout'])) {
      $_SESSION['logged_in'] = 0;
      $this->redirect('landing');
    }

    if(isset($_POST['deleteACC'])) {

      $profileManager->deleteAccount($_SESSION['userID']);

      $_SESSION['logged_in'] = 0;
      session_destroy();
      $this->redirect('landing');
    }


  }
  else
  {
    $this->redirect('landing');
  }


  }

}
 ?>
