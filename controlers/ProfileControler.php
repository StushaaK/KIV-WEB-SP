<?php
session_start();

class ProfileControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Profil',
      'keywords' => 'profil, profile, avatar, user',
      'description' => 'Stránka přihlášeného uživatele'
    );


  //Pouze pokud je uživatel přihlášen
  if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in']))
  {

    $this->data['showArticles']="table-striped";

    // Administrátor
    if($_SESSION['accountType']=="administrátor") {
      $profileManager = new ProfileManager();
      $this->data['users']=$profileManager->getAllUsers($_SESSION['userID']);
      $this->data['articles']=$profileManager->getArticlesAndReviews();
      $this->data['reviewers']=$profileManager->getReviewers(1);


      //Vypni zobrazení prázdných tabulek
      if (empty($this->data['articles'])) $this->data['showArticles']="d-none";

      if(isset($_POST['deleteUser'])) {

        $profileManager->deleteAccount($_POST['user_id']);

        $this->redirect('profile');
      }

      if(isset($_POST['promote'])) {
        $_SESSION['message'] = "Uživateli byl přidělen/odebrán status recenzenta";
        $profileManager->changeReviewerStatus($_POST['user_id']);

        $this->redirect('profile');
      }

      if (isset($_POST['publish'])) {
        $_SESSION['message'] = "Přípěvek byl publikován";
        $profileManager->publishArticle($_POST['article_id']);


        $this->redirect('profile');
      }

      if (isset($_POST['reject'])) {
        $_SESSION['message'] = "Přípěvek byl zamítnut";
        $profileManager->rejectArticle($_POST['article_id']);


        $this->redirect('profile');
      }

      if (isset($_POST['assignReview'])) {
        $_SESSION['message'] = "Uživateli byl přidělen příspěvek k posouzení";
        $profileManager->assignReview($_POST['reviewer_id'], $_POST['article_id']);


        $this->redirect('profile');
      }

      if (isset($_POST['deleteReview'])) {
        $_SESSION['message'] = "Hodnocení smazáno";
        $profileManager->deleteReview($_POST['review_id']);


        $this->redirect('profile');
      }



      $this->view = 'adminDashboard';

    }


    // Recenzent
    else if($_SESSION['accountType']=="recenzent") {
      $profileManager = new ProfileManager();
      $this->data['articles']=$profileManager->getAllCreatedArticles($_SESSION['userID']);
      $this->data['reviews']=$profileManager->getAllUserReviews($_SESSION['userID']);

      //Vypni zobrazení prázdných tabulek
      $this->data['showReviews']="table-striped";
      if (empty($this->data['articles'])) $this->data['showArticles']="d-none";
      if (empty($this->data['reviews'])) $this->data['showReviews']="d-none";

      $this->view = "reviewerDashboard";

      $reviewsByUser=$profileManager->getAllUserReviewsID($_SESSION['userID']);

      if(isset($_POST['editReview'])) {
        //Ošetření hidden elementu, kontorla zda uživatel vlastní danou recenzi
        if (in_array($_POST['review_id'], $reviewsByUser)) {
          $this->data['review']=$profileManager->getReview($_POST['review_id']);

          $this->view = 'review';
        }


      }

      if (isset($_POST['saveReview']) && in_array($_POST['review_id'], $reviewsByUser)) {
        $reviewArray = array($_POST['originality'], $_POST['theme'], $_POST['technical'], $_POST['language'], $_POST['recommendation'], $_POST['comment'], $_POST['review_id']);


        $profileManager->changeReview($reviewArray);
        $this->redirect('profile');
      }

      if (isset($_POST['publish']) && in_array($_POST['review_id'], $reviewsByUser)) {
        $_SESSION['message'] = "Stav publikování recenze byl změněn";
        $profileManager->changePublishedStatusReview($_POST['review_id']);

        $this->redirect('profile');
      }

      if (isset($_POST['deleteReview']) && in_array($_POST['review_id'], $reviewsByUser)) {
        $_SESSION['message'] = "Recenze s byla smazána";
        $profileManager->deleteReview($_POST['review_id']);

        $this->redirect('profile');
      }


    }

    //Pokud se nejedná o administrátora ani recenzenta
    else {
      //Všechny příspěvky, které psal uživatel
      $profileManager = new ProfileManager();
      $this->data['articles']=$profileManager->getAllCreatedArticles($_SESSION['userID']);

      //Vypni zobrazení prázdných tabulek
      if (empty($this->data['articles'])) $this->data['showArticles']="d-none";

      $this->view = 'profile';
    }



    //Pro všechny uživatele stejné
    if(isset($_POST['deleteArticle'])) {
      $articlesByUser=$profileManager->getAllCreatedArticlesID($_SESSION['userID']);

      //Ošetření hidden elementu, kontorla zda uživatel napsal daný článek
      if ($_SESSION['accountType']=="administrátor" OR in_array($_POST['article_id'], $articlesByUser)) {
      $_SESSION['message'] = "Bylo smazáno ".$profileManager->deleteArticle($_POST['article_id'])." položek";
      $this->redirect('profile');
      }
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
         $_SESSION['message'] = 'Nepodařilo se vložit PDF soubor!';
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
