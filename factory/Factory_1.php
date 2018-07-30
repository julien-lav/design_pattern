<?php

/**
 * summary
 */
class DBFactory
{
    public static function ($dbConnectString)
    {
    	if(strpos ($dbConnectString, ':')) === false)
    	{
    		throw new Exception('Bad string');	
    	}	
     	switch (substr ($dbConnectString, 0, $strpos ($dbConnectString, ':')))){
        	case 'mysql':
        		$db = new DBMySql ($connectionString1);
			break;
         	case 'oracle':
            	$db = new DBOracle ($connectionString1);
            break;
        	default:
            	throw new Exception ('Type de base inconnu');
      }
      return $db;
    } 
}

$db = DBFactory::create ('mysql://user:password@localhost');
//Plus loin
$db2 = DBFactory::create ('oracle://user:password@localhost')