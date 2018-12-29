<?php

class Db
{
  private static $connection;

  private static $settings = array (
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false,
  );

  public static function connect($host, $user, $password, $database) {
    if(!isset(self::$connection)) //Pokud neexistuje spojení
    {
      self::$connection = @new PDO(
        "mysql:host=$host;dbname=$databse", $user, $password, self::$settings
      );
    }
  }

  public static function getOneRow($statement, $parameters = array())
  {
    $returned = self::$connection->prepare($statement);
    $returned->execute($parameters);
    return $returned->fetch();
  }

  public static function getAll($statement, $parameters = array())
  {
    $returned = self::$connection->prepare($statement);
    $returned->execute($parameters);
    return $returned->fetchAll();
  }

  public static function getOneColumn($statement, $parameters = array())
  {
    $returned = self::getOneRow($statement, $parameters);
    return $returned[0];
  }

  public static function affectedRows($statement, $parameters = array())
  {
    $returned = self::$connection->prepare($statement);
    $returned->execute($parameters);
    return $returned->rowCount();

  }

  public static function insertRow($statement, $parameters = array())
  {
    $insert = self::$connection->prepare($statement);
    $insert->execute($parameters);
    return "Vložení proběhlo vpořádku";
  }

}


 ?>
