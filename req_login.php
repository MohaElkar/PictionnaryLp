<?php 
	include("PDOConnexion.php");

	$email = stripslashes($_POST["email"]);
	$password = stripslashes($_POST["password"]);

	try {
	    // Connexion à la base de donné.
		$dbh = PDOConnexion::getInstance();	    
	    // Vérifier si un utilisateur avec cette adresse email existe dans la table.	    
	    $req = $dbh->executer("select * from users where email = :email and password = :password", array( ':email' => $email, ':password' => $password) );          
	       	
	    // Utilisateur trouvé.
	    if ( $req->rowCount() === 1) {
            session_start();

            // on récupère les valeurs de la requete. 
            $res = $req->fetch();

            // on enregistre les données dans la session
            $_SESSION["id"]         = $res["id"];
            $_SESSION["email"]      = $res["email"];
            $_SESSION["nom"]        = $res["nom"];
            $_SESSION["prenom"]     = $res["prenom"];
            $_SESSION["couleur"]    = $res["couleur"];
            $_SESSION["profilepic"] = $res["profilepic"];

            // Redirection vers main.
            header('Location: main.php');
	    }
	    else {
	     	// Aucun utilisateur trouvé
            header('Location: error.php?erreur='.urlencode("Aucun utilisateur trouvé."));
	    }
	    
	    $dbh = null;
	} catch (PDOException $e) {
	    print "Erreur !: " . $e->getMessage() . "<br/>";
	    $dbh = null;
	    die();
	}
?>