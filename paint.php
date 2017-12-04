<?php include("header.php"); ?> 


<?php if (!isset($_SESSION["id"])): ?>
    
    <div class="alert alert-info">
        <p>Veuillez vous connecter pour dessiner.</p>
    </div>

<?php else: ?>

    <!-- Affichage message succes -->
    <?php if (isset($_GET["success"])): ?>
    
    <div class="alert alert-success">
        <p><?= $_GET["success"] ?></p>
    </div>

    <?php endif; ?>

    <canvas id="myCanvas" style="border:1px solid #000000;"></canvas>  
      
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

<script type="text/javascript">
    /*Paint.php*/
    // les quatre tailles de pinceau possible.  
    var sizes=[8,20,44,90];  
    // la taille et la couleur du pinceau  
    var size, color;  
    // la dernière position du stylo  
    var x0, y0;  
    // le tableau de commandes de dessin à envoyer au serveur lors de la validation du dessin  
    var drawingCommands = [];  

    var setColor = function() {  
        // on récupère la valeur du champs couleur  
        color = document.getElementById('color').value;  
        console.log("color:" + color);  
    }  

    var setSize = function() {  
        // ici, récupèrez la taille dans le tableau de tailles, en fonction de la valeur choisie dans le champs taille.  
        size = sizes[document.getElementById("size").value];
        console.log("size:" + size);  
    }  

    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    }

    window.onload = function() {  
        var canvas = document.getElementById('myCanvas');  
        canvas.width = 400;  
        canvas.height= 400;  
        var context = canvas.getContext('2d');  

        setSize();  
        setColor();  
        document.getElementById('size').onchange = setSize;  
        document.getElementById('color').onchange = setColor;  

        var isDrawing = false;  

        var startDrawing = function(e) {  
            console.log("start");  

            var mousePos = getMousePos(canvas, e);

            // crér un nouvel objet qui représente une commande de type "start", avec la position, la couleur  
            var command = {};  
            command.command="start";  
            command.x= mousePos.x; 
            command.y= mousePos.y;   
            command.color = color;
            command.taille = size;               

            // on l'ajoute à la liste des commandes  
            drawingCommands.push(command);  

            // ici, dessinez un cercle de la bonne couleur, de la bonne taille, et au bon endroit.
            context.beginPath();
            context.arc(command.x, command.y, command.taille, 0, 2 * Math.PI, false);
            context.fillStyle = command.color;
            context.fill();

            isDrawing = true;  
        }  

        var stopDrawing = function(e) {  
            console.log("stop");  
            isDrawing = false;  
        }  

        var draw = function(e) {  
            if(isDrawing) {  
                // ici, créer un nouvel objet qui représente une commande de type "draw", avec la position, et l'ajouter à la liste des commandes. 
                var mousePos = getMousePos(canvas, e);

                var command = {};
                command.command = "draw";
                command.x= mousePos.x; 
                command.y= mousePos.y;  
                command.taille = size; 
                command.color = color; 
                 console.log(command);

                drawingCommands.push(command); 

                // Trait continu.
                context.lineWidth = command.taille;
                context.fillStyle = command.color
                context.lineTo(command.x, command.y);
                context.strokeStyle = command.color;
                context.stroke();          
            }  
        }  

        canvas.onmousedown = startDrawing;  
        canvas.onmouseout = stopDrawing;  
        canvas.onmouseup = stopDrawing;  
        canvas.onmousemove = draw;  

        document.getElementById('restart').onclick = function() {  
            console.log("clear");  
            // ici ajouter à la liste des commandes une nouvelle commande de type "clear"  
            var command = {};
            command.command = "clear";

            // ici, effacer le context, grace à la méthode clearRect.                
            context.clearRect(0,0,canvas.width, canvas.height); 
        };  

        document.getElementById('validate').onclick = function() {  
            // la prochaine ligne transforme la liste de commandes en une chaîne de caractères, et l'ajoute en valeur au champs "drawingCommands" pour l'envoyer au serveur.  
            document.getElementById('drawingCommands').value = JSON.stringify(drawingCommands);  

            // ici, exportez le contenu du canvas dans un data url, et ajoutez le en valeur au champs "picture" pour l'envoyer au serveur. 
            document.getElementById("picture").value = canvas.toDataURL();
        };  
    };  
</script>

<?php include("footer.php"); ?> 
