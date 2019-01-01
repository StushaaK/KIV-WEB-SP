<?php
class ProfileManager
{

  public function getAllCreatedArticles($userID)
  {
    return Db::getAll('
    SELECT * FROM conferention.articles WHERE id_user = ?
    ', array($userID));
  }

  public function getAllCreatedArticlesID($userID)
  {
    return Db::getOneColumn('
    SELECT id FROM conferention.articles WHERE id_user = ?
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

  public function getAllUserReviews($reviewerID)
  {
    return Db::getAll('
    SELECT articles.title, reviews.id, reviews.originality_score, reviews.theme_score, reviews.technical_score, reviews.language_score, reviews.recommendation, reviews.published
     FROM conferention.reviews INNER JOIN conferention.articles ON reviews.articles_id = articles.id WHERE reviews.user_id = ?
    ', array($reviewerID));
  }

  public function getAllUserReviewsID($reviewerID)
  {
    return Db::getOneColumn('
    SELECT id FROM conferention.reviews WHERE user_id = ?
    ', array($reviewerID));
  }

  public function getReview($reviewID) {
    return Db::getOneRow('
    SELECT articles.title, articles.pdf, reviews.id, reviews.originality_score, reviews.theme_score, reviews.technical_score, reviews.language_score, reviews.recommendation, reviews.comment
     FROM conferention.reviews INNER JOIN conferention.articles ON reviews.articles_id = articles.id WHERE reviews.id = ?
    ', array($reviewID));
  }

  public function changeReviewerStatus($reviewerID)
  {
    return Db::affectedRows('
    UPDATE conferention.users SET reviewer = (reviewer ^ 1) WHERE id = ?
    ', array($reviewerID));
  }

  public function changePublishedStatusArticle($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.articles SET published = (published ^ 1) WHERE id = ?
    ', array($publishedID));
  }

  public function changePublishedStatusReview($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.reviews SET published = (published ^ 1) WHERE id = ?
    ', array($publishedID));
  }

  public function changeReview($reviewArray)
  {
    return Db::affectedRows('
    UPDATE conferention.reviews SET originality_score = ?, theme_score = ?, technical_score = ?, language_score = ?, recommendation = ?, comment = ? WHERE id = ?
    ', $reviewArray);
  }

  public function deleteArticle($articleID)
  {
    return Db::affectedRows('
    DELETE FROM conferention.articles WHERE id = ?
    ', array($articleID));
  }

  public function deleteReview($reviewID)
  {
    return Db::affectedRows('
    DELETE FROM conferention.reviews WHERE id = ?
    ', array($reviewID));
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
