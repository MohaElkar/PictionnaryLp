<?php include("header.php"); ?>
	
	<section class="erreurPage">
		<h2>Une erreur est survenu.</h2>

		<p>Message : <?php echo (isset($_GET["erreur"]) && !empty($_GET["erreur"])) ?  $_GET["erreur"] : 'Aucun message' ?></p>
	</section>
	

<?php include("footer.php"); ?>