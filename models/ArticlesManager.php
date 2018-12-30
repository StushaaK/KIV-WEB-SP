<?php

class ArticlesManager
{

  public function getAllArticles()
  {
    return Db::getAll('
    SELECT * FROM conferention.articles WHERE published = 1
    ', array());
  }

}

 ?>
