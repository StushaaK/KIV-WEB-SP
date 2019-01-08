<?php

class ArticlesManager
{

  public function getAllArticles()
  {
    return Db::getAll('
    SELECT * FROM conferention.articles WHERE state = 3
    ', array());
  }

  public function getArticleAverageScore($articleID)
  {
    return Db::getOneColumn('
    SELECT AVG(reviews.average) FROM conferention.reviews WHERE reviews.article_id = ?
    ', array($articleID));
  }

}

 ?>
