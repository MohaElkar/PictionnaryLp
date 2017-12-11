<?php 
	session_start(); 
	include("PDOConnexion.php");
?>

<!DOCTYPE html>  
<html>  
    <head>  
        <meta charset=utf-8 />  
        <title>Pictionnary</title>  

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" media="screen" href="css/styles.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">  
    </head>  
    
    <body> 
    	<nav class="navbar navbar-inverse">
	    	<div class="container">
	    		<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="main.php">Pictionnary LP</a>
	    		</div>
	    		
	    		<div id="navbar" class="navbar-collapse collapse">
	    			<?php if(!isset($_SESSION['id'])): ?>
	    			<form action="req_login.php" method="POST" class="navbar-form navbar-right">
	    				<div class="form-group">
	    					<input type="email" name="email" required placeholder="Votre adresse email" class="form-control">
	    				</div>
	    				<div class="form-group">
	    				  	<input type="password" name="password" required placeholder="Votre mot de passe" class="form-control">
	    				</div>
	    				
	    				<button type="submit" class="btn btn-success">Se connecter</button>
	    				<a href="inscription.php" class="btn btn-info">Inscription</a>
	    			</form>

		    		<?php else: ?>	    			
		    			<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<img src="<?= $_SESSION["profilepic"] ?>" width="20" height="20">
									Bienvenue <?= $_SESSION["nom"] ?> 
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu">			            
									<li><a href="logout.php">Déconnexion</a></li>
								</ul>
							</li>
						</ul>
		    		<?php endif; ?>
		    		
	    		</div><!--/.navbar-collapse -->

	    	</div>
	    </nav>

    	<section class="container">
    		
