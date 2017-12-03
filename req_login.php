<?php 
	$email = stripslashes($_POST["email"]);
	$password = stripslashes($_POST["password"]);

	try {
	    // Connect to server and select database.
	    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

	    // Vérifier si un utilisateur avec cette adresse email existe dans la table.
	    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
	    $sql = $dbh->prepare("select * from users where email = :email and password = :password");
	    $sql->bindValue(":email", $email);    
	    $sql->bindValue(":password", $password);    
	    $sql->execute();
    
	    if ( $sql->rowCount() === 1) {
	       	// utilisateur trouvé.
            session_start();

            // on récupère les valeurs de la requete. 
            $res = $sql->fetch();

            // on enregistre les données dans la session
            $_SESSION["id"]         = $res["id"];
            $_SESSION["email"]      = $res["email"];
            $_SESSION["nom"]        = $res["nom"];
            $_SESSION["prenom"]     = $res["prenom"];
            $_SESSION["couleur"]    = $res["couleur"];
            $_SESSION["profilepic"] = $res["profilepic"];

            // redirection vers main.
            header('Location: main.php');
	    }
	    else {
	     	// aucun utilisateur trouvé
            header('Location: main.php?erreurs='.urlencode("Aucun utilisateur trouvé."));
	    }
	    
	    $dbh = null;
	} catch (PDOException $e) {
	    print "Erreur !: " . $e->getMessage() . "<br/>";
	    $dbh = null;
	    die();
	}
?>