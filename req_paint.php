<?php
	session_start();
	include("PDOConnexion.php");

	$id_user 	= $_SESSION["id"]; 
	$commandes 	= stripslashes($_POST["drawingCommands"]);
	$picture	= stripslashes($_POST["picture"]);

	try {
	    // Connexion à la base de donné.
		$dbh = PDOConnexion::getInstance();
	    
	    $req = $dbh->executer("INSERT INTO drawings (id, id_user, commande, dessin) VALUES (NULL, :id_user, :commandes, :picture)", 
	    	array( 
	    		':id_user' 		=> $id_user, 
	    		':commandes' 	=> $commandes,
	    		':picture' 		=> $picture,
	    	) 
	    );          

        // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
        if (!$req) {
            echo "PDO::errorInfo():<br/>";
            $err = $req->errorInfo();
            print_r($err);
        } else {
        	// redirection vers la page paint avec message success.
        	header("Location: paint.php?success=".urlencode("Votre dessin a été enregistré"));
        }
	    
	    $dbh = null;
	} catch (PDOException $e) {
	    print "Erreur !: " . $e->getMessage() . "<br/>";
	    $dbh = null;
	    die();
	}
?>