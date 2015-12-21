<?php
namespace Application\Db;
use PDO;
//use const \includes\config\HOST;
//use const \includes\config\DATABASE_NAME;
//use const \includes\config\USER_NAME;
//use const \includes\config\PASSWORD;

class db
{
	
/*** Declare instance ***/
private static $instance = NULL;
	
/**
*
* the constructor is set to private so
* so nobody can create a new instance using new
*
*/
private function __construct() 
{
  /*** maybe set the db name here later ***/
}
/**
*
* Return DB instance or create intitial connection
*
* @return object (PDO)
*
* @access public
*
*/
public static function getInstance() 
{
    if (!self::$instance)
    {
        
            self::$instance = new PDO("mysql:host=".HOST.";dbname=".DATABASE_NAME."", USER_NAME,PASSWORD);
            self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$instance;
}
/**
*
* Like the constructor, we make __clone private
* so nobody can clone the instance
*
*/
private function __clone(){
}
} /*** end of class ***/
