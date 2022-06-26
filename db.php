<?php

	class Base
	{
		private static $db = 'dispensadorm2' ;
		private static $dbHost = 'localhost' ;
		private static $dbUser = 'gaston';
		private static $dbUserPass = 'dispensadorm2';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect()
		{
		   if ( null == self::$cont )
		   {     
			try
			{
			  self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$db, self::$dbUser, self::$dbUserPass); 
			}
			catch(PDOException $e)
			{
			  die($e->getMessage()); 
			}
		   }
		   return self::$cont;
		}
		 
		public static function disconnect()
		{
			self::$cont = null;
		}
	}
?>