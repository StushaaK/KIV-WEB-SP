<?php

class LoginManager
{

  public function checkEmail($email)
  {
  return Db::affectedRows('
    SELECT * FROM conferention.users WHERE email = ?
  ', $email);
  }

  public function getUser($userArray)
  {
    return DB::getOneRow('
      SELECT * FROM conferention.users WHERE email = ?
    ', $userArray);
  }

}

 ?>
