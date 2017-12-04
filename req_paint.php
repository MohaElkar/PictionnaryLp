<?php
	session_start();

	$id_user 	= $_SESSION["id"]; 
	$commandes 	= stripslashes($_POST["drawingCommands"]);
	$picture	= stripslashes($_POST["picture"]);

	try {
	    // Connect to server and select database.
	    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

	    $sql = $dbh->prepare("INSERT INTO drawings (id, id_user, commande, dessin) VALUES (NULL, :id_user, :commandes, :picture)");

        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":commandes", $commandes);
        $sql->bindValue(":picture", $picture);

        // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
        if (!$sql->execute()) {
            echo "PDO::errorInfo():<br/>";
            $err = $sql->errorInfo();
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