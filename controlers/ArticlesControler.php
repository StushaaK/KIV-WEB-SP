<?php
session_start();

class ArticlesControler extends Controler {

  public function process($parameters) {
    $this->header = array (
      'title' => 'Publikované články',
      'keywords' => 'articles, články, publikované, published',
      'description' => 'Publikované články v konferenci'
    );

  $articlesManager = new ArticlesManager();
  $articles=$articlesManager->getAllArticles();
  $this->data['articles'] = $articles; 

  $this->view = 'articles';

  }

}
 ?>
