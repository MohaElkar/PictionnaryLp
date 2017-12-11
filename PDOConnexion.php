<?php 
	class PDOConnexion{
		static private $instance = null;
		private $pdo;

		const DB_NAME 	= "pictionnary";
		const LOGIN 	= "test";
		const PASSWORD 	= "test";

		private function __construct(){
			$this->pdo = new PDO('mysql:host=localhost;dbname='.self::DB_NAME, self::LOGIN, self::PASSWORD);
		}

		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new PDOConnexion();
			}

			return self::$instance;
		}

		public function executer($requete, $datasArray = null){
            $req = $this->pdo->prepare($requete);

            if($datasArray!=null){
            	foreach ($datasArray as $key => $value) {
					$req->bindValue($key, $value);
            	}
            }

            $req->execute();

			return $req;
		}
	}
?>