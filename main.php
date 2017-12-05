<?php include("header.php"); ?> 

<div id="dessins">

	<?php if (isset($_GET["erreurs"])): ?>

		<div class="alert alert-danger">
			<p><?= $_GET["erreurs"]; ?></p>
		</div>

	<?php endif; ?>

	<?php if (!isset($_SESSION["id"])): ?>
	
		<div class="alert alert-info">
			<p>Connectez-vous pour voir vos dessins</p>
		</div>

	<?php else: ?>

	<h2>Vos dessins :</h2>

	<div class="row">		
		<?php 
			try {
			    // Connect to server and select database.
			    $dbh = PDOConnexion::getInstance();

			    // Vérifier si un utilisateur avec cette adresse email existe dans la table.
			    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
			    $sql = $dbh->prepare("select * from drawings where id_user = :id_user");
			    $sql->bindValue(":id_user", $_SESSION["id"]);    
			    $sql->execute();
			   
			    $res = $sql->fetchAll();

			    for($i = 0; $i<count($res); $i++){
			    	echo '<div class="col-xs-6 col-md-3">';
				    	echo '<a href="guess.php?id='.$res[$i]["id"].'" class="thumbnail">';
				    		echo '<img src="'.$res[$i]["dessin"].'" alt="Dessin n°'.$res[$i]["id"].'">';
				    	echo '</a>';
			    	echo '</div>';
			    }

			    $dbh = null;
			    
			} catch (PDOException $e) {
			    print "Erreur !: " . $e->getMessage() . "<br/>";
			    $dbh = null;
			    die();
			}
		?>

	</div>
	<?php endif; ?>


	<a href="paint.php" class="btn btn-block btn-success btn-lg">Dessiner</a>
</div>

<?php include("footer.php"); ?> 