<?php include("header.php"); ?>

	<h1>Une erreur est survenu.</h1>

	<p>Message : <?php echo (isset($_GET["erreur"]) && !empty($_GET["erreur"])) ?  $_GET["erreur"] : 'Aucun message' ?></p>
<?php include("footer.php"); ?>