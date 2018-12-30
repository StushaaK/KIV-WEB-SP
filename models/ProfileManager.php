<?php
class ProfileManager
{

  public function getAllCreatedArticles($userID)
  {
    return Db::getAll('
    SELECT * FROM conferention.articles WHERE id_user = ?
    ', array($userID));
  }

  public function getAllUsers($userID)
  {
    return Db::getAll('
    SELECT id, username, email, avatar, reviewer FROM conferention.users WHERE id != ?
    ', array($userID));
  }

  public function getAllArticles()
  {
    return Db::getAll('
    SELECT * FROM conferention.articles
    ', array());
  }

  public function changeReviewerStatus($reviewerID)
  {
    return Db::affectedRows('
    UPDATE conferention.users SET reviewer = (reviewer ^ 1) WHERE id = ?
    ', array($reviewerID));
  }

  public function changePublishedStatus($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.articles SET published = (published ^ 1) WHERE id = ?
    ', array($publishedID));
  }

  public function deleteArticle($articleID)
  {
    return Db::affectedRows('
    DELETE FROM conferention.articles WHERE id = ?
    ', array($articleID));
  }

  public function insertArticle($articleArray)
  {
    Db::insertRow('
        INSERT INTO conferention.articles (id_user, title, authors, abstract, pdf, published) VALUES (?, ?, ?, ?, ?, ?)
      ', $articleArray);
  }



  public function deleteAccount($userID)
  {

    Db::affectedRows('
    DELETE FROM conferention.articles WHERE id_user = ?
    ', array($userID));

    Db::affectedRows('
    DELETE FROM conferention.users WHERE id = ?
    ', array($userID));

  }

}
 ?>
