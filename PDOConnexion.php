<?php 
	class PDOConnexion{
		static private $instance = null;

		//mysql:host=localhost;dbname=pictionnary', 'test', 'test
		const DB_NAME 	= "pictionnary";
		const LOGIN 	= "test";
		const PASSWORD 	= "test";

		private function __construct(){
			self::$instance = new PDO('mysql:host=localhost;dbname='.self::DB_NAME, self::LOGIN, self::PASSWORD);
		}

		public static function getInstance(){
			if(self::$instance === null)
				new PDOConnexion();
				return self::$instance;
			return self::$instance;
		}
	}
?>