<?php
class ProfileManager
{

  public function getAllCreatedArticles($userID)
  {
    $articlesArray = Db::getAll('
    SELECT * FROM conferention.articles WHERE id_user = ?
    ', array($userID));

    foreach ($articlesArray as $key => $article) {

      switch($article['state']) {
      case 0:
            $articlesArray[$key]['state'] = "čeká na vyjádření";
            break;
      case 1:
            $articlesArray[$key]['state'] = "odmítnut";
            break;
      case 2:
            $articlesArray[$key]['state'] = "v recenzním řízení";
            break;
      case 3:
            $articlesArray[$key]['state'] = "přijat";
            break;
      default:
          $articlesArray[$key]['state'] = "čeká na vyjádření";
    }
  }
  return $articlesArray;
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

  public function getReviewers($reviewerStatus)
  {
    return Db::getAll('
    SELECT users.id, users.username FROM conferention.users WHERE users.reviewer = ?;
    ', array($reviewerStatus));
  }

  public function getAllArticles()
  {
    $articlesArray = Db::getAll('
    SELECT * FROM conferention.articles
    ', array());

    foreach ($articlesArray as $key => $article) {

      switch($article['state']) {
      case 0:
            $articlesArray[$key]['state'] = "čeká na vyjádření";
            break;
      case 1:
            $articlesArray[$key]['state'] = "odmítnut";
            break;
      case 2:
            $articlesArray[$key]['state'] = "v recenzním řízení";
            break;
      case 3:
            $articlesArray[$key]['state'] = "přijat";
            break;
      default:
          $articlesArray[$key]['state'] = "čeká na vyjádření";
    }
  }
  return $articlesArray;
  }

  public function getArticlesAndReviews()
  {
    $articlesArray = Db::getAll('
    SELECT * FROM conferention.articles
    ', array());

    foreach ($articlesArray as $key => $article) {

      switch($article['state']) {
      case 0:
            $articlesArray[$key]['state'] = "čeká na vyjádření";
            break;
      case 1:
            $articlesArray[$key]['state'] = "odmítnut";
            break;
      case 2:
            $articlesArray[$key]['state'] = "v recenzním řízení";
            break;
      case 3:
            $articlesArray[$key]['state'] = "přijat";
            break;
      default:
          $articlesArray[$key]['state'] = "čeká na vyjádření";
    }

    $articlesArray[$key]['reviews'] = $this->getAllArticleReviews($article['id']);
  }
  return $articlesArray;
  }

  public function getAllArticleReviews($articleID)
  {
    return Db::getAll('
      SELECT users.username, reviews.id, reviews.originality_score, reviews.theme_score, reviews.technical_score, reviews.language_score, reviews.recommendation, reviews.average, reviews.published
      FROM conferention.reviews INNER JOIN conferention.users ON reviews.user_id = users.id WHERE reviews.article_id = ?
    ', array($articleID));
  }

  public function getAllUserReviews($reviewerID)
  {
    return Db::getAll('
    SELECT articles.title, reviews.id, reviews.originality_score, reviews.theme_score, reviews.technical_score, reviews.language_score, reviews.recommendation, reviews.average, reviews.published
     FROM conferention.reviews INNER JOIN conferention.articles ON reviews.article_id = articles.id WHERE reviews.user_id = ?
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
     FROM conferention.reviews INNER JOIN conferention.articles ON reviews.article_id = articles.id WHERE reviews.id = ?
    ', array($reviewID));
  }

  public function changeReviewerStatus($reviewerID)
  {
    return Db::affectedRows('
    UPDATE conferention.users SET reviewer = (reviewer ^ 1) WHERE id = ?
    ', array($reviewerID));
  }

  public function publishArticle($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.articles SET state = 3 WHERE id = ?
    ', array($publishedID));
  }

  public function rejectArticle($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.articles SET state = 1 WHERE id = ?
    ', array($publishedID));
  }

  public function articleReviewed($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.articles SET state = 2 WHERE id = ?
    ', array($publishedID));
  }

  public function changePublishedStatusReview($publishedID)
  {
    return Db::affectedRows('
    UPDATE conferention.reviews SET published = (published ^ 1) WHERE id = ?
    ', array($publishedID));
  }

  public function assignReview($userID, $articleID) {
    Db::affectedRows('
    INSERT INTO conferention.reviews (user_id, article_id) VALUES (?, ?)
    ', array($userID, $articleID));

    $this->articleReviewed($articleID);
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
        INSERT INTO conferention.articles (id_user, title, authors, abstract, pdf, state) VALUES (?, ?, ?, ?, ?, ?)
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
