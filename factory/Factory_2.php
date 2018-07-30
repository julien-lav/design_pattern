<?php 

/*
* La class Usine !	
*/
class DBFactory 
{
	public static function load($sgbdr)
	{
		$classe = 'SGBDR_' . $sgbdr;

		if (file_exists($chemin = $classe . '.class.php'))
		{
			require $chemin;
			return new $classe;
		}
		else 
		{
			throw new RunTimeException('Le classe' . $classe . '>> introuvable' );
		}


	}
}
/*
try
{
  $mysql = DBFactory::load('MySQL');
}
catch (RuntimeException $e)
{
  echo $e->getMessage();
}
*/
class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
  
  public static function getPgsqlConnexion()
  {
    $db = new PDO('pgsql:host=localhost;dbname=tests', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}