<?php

class ArticlesManager
{

  public function getAllArticles()
  {
    return Db::getAll('
    SELECT * FROM conferention.articles WHERE state = 3
    ', array());
  }

}

 ?>
