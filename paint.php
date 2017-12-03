<?php include("header.php"); ?> 


<?php if (!isset($_SESSION["id"])): ?>
    
    <div class="alert alert-info">
        <p>Veuillez vous connecter pour dessiner.</p>
    </div>

<?php else: ?>

    <canvas id="myCanvas"></canvas>  
      
    <form name="tools" action="req_paint.php" method="post">  
        <!-- ici, insérez un champs de type range avec id="size", pour choisir un entier entre 0 et 4) -->  
        <input type="range" id="size" value="0" min="0" max="3">
        <!-- ici, insérez un champs de type color avec id="color", et comme valeur l'attribut  de session couleur (à l'aide d'une commande php echo).) -->  
        <input type="color" id="color" value="#<?= $_SESSION["couleur"] ?>">

        <input id="restart" type="button" value="Recommencer"/>  
        
        <input type="hidden" id="drawingCommands" name="drawingCommands"/>  
        <!-- à quoi servent ces champs hidden ? -->  
        <input type="hidden" id="picture" name="picture"/>  
        <input id="validate" type="submit" value="Valider"/>  
    </form>  

<?php endif; ?>

<?php include("footer.php"); ?> 
