<?php

class RegistrationManager
{

  public function registerUser($userArray)
  {
    $_SESSION['username'] = $userArray[0];
    $_SESSION['avatar'] = $userArray[3];

    Db::insertRow('
      INSERT INTO conferention.users (username, email, password, avatar, admin, reviewer) VALUES (?, ?, ?, ?, ?, ?)
    ', $userArray);
  }

}

 ?>
