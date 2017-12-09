<?php include("header.php"); ?> 


<?php if (!isset($_SESSION["id"])): ?>
    
    <div class="alert alert-info">
        <p>Veuillez vous connecter pour dessiner.</p>
    </div>

<?php else: ?>

    <!-- Affichage message success -->
    <?php if (isset($_GET["success"])): ?>
    
    <div class="alert alert-success">
        <p><?= $_GET["success"] ?></p>
    </div>

    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6">
            <h2>Canvas :</h2>
            <canvas id="myCanvas"></canvas>  
        </div>

        <div class="col-lg-6">
            <h2>Outils :</h2>

            <form name="tools" action="req_paint.php" method="post">  
                <ul class="listInputDessin">
                    <li>  
                        <label for="size">Taille pinceau :</label>  
                        <input type="range" class="form-control" id="size" value="0" min="0" max="3">
                    </li> 

                    <li>  
                        <label for="color">Couleur pinceau :</label>  
                        <input type="color" class="form-control" id="color" value="#<?= $_SESSION["couleur"] ?>">
                    </li> 

                    <li>  
                        <label for="effacer">Effacer :</label>  
                        <input id="restart" type="button" class="btn btn-default btn-block" id="effacer" value="Recommencer"/> 
                    </li> 

                    <li>  
                        <label for="effacer">Sauvegarder :</label>  
                        <input id="validate" type="submit" class="btn btn-primary btn-block" value="Sauvegarder le dessin"/>  
                    </li>  
                </ul>
                
                <input type="hidden" id="drawingCommands" name="drawingCommands"/>  
                <input type="hidden" id="picture" name="picture"/>  
            </form>  
        </div>
    </div>

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

            drawingCommands.push(command);

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
