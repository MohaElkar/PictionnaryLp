<?php 
	class PDOConnexion{
        const DB_NAME 	= "pictionnary";
        const LOGIN 	= "test";
        const PASSWORD 	= "test";

        // Instance de PDOConnexion
		static private $instance = null;
		private $pdo;

        /**
         * L'encapsulation du construction est privé afin de limiter l'instanciation des object.
         */
		private function __construct(){
			$this->pdo = new PDO('mysql:host=localhost;dbname='.self::DB_NAME, self::LOGIN, self::PASSWORD);
		}

        /**
         * Retourne une instance de PDOConnexion.
         * getInstance permet de controler l'instanciation de la classe PDOConnexion.
         */
		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new PDOConnexion();
			}

			return self::$instance;
		}

        /**
         * Execute la requete "$requete".
         * DatasArray corresponds aux données à binder à la requete.
         */
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