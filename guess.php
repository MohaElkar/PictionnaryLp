<?php  
include "header.php";  

if(!isset($_SESSION['id'])) {  
    header("Location: main.php");  
} else {  
 // ici, récupérer la liste des commandes dans la table DRAWINGS avec l'identifiant $_GET['id']  
 // l'enregistrer dans la variable $commands  
    $commands = "";

    try {
        // Connect to server and select database.
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

        $sql = $dbh->prepare("SELECT commande from drawings where id = :id and id_user = :id_user");

        $sql->bindValue(":id", $_GET["id"]);
        $sql->bindValue(":id_user", $_SESSION["id"]);
        $sql->execute();

         if ( $sql->rowCount() === 1) {
            $commands = $sql->fetch()[0];
         }
        
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        $dbh = null;
        die();
    }

}  
?>  

    <script>  
      // la taille et la couleur du pinceau  
        var size, color;  
        // la dernière position du stylo  
        var x0, y0;  
        // le tableau de commandes de dessin à envoyer au serveur lors de la validation du dessin  
        var drawingCommands = <?php echo $commands;?>; 
        console.log(drawingCommands); 
  
        window.onload = function() {  
            var canvas = document.getElementById('myCanvas');  
            canvas.width = 400;  
            canvas.height= 400;  
            var context = canvas.getContext('2d');  
  
            var start = function(c) {  
                // complétez  
                context.beginPath();
                context.arc(c.x, c.y, c.taille, 0, 2 * Math.PI, false);
                context.fillStyle = c.color;
                context.fill();
            }  
  
            var draw = function(c) {  
                // complétez  
                // Trait continu.
                context.lineWidth = c.taille;
                context.fillStyle = c.color
                context.lineTo(c.x, c.y);
                context.strokeStyle = c.color;
                context.stroke();          
            }  
  
            var clear = function() {  
                // complétez  
                context.clearRect(0,0,canvas.width, canvas.height); 
            }  
  
            // étudiez ce bout de code  
            var i = 0;  
            var iterate = function() {  
                if(i>=drawingCommands.length)  
                    return;  
                var c = drawingCommands[i];  
                switch(c.command) {  
                    case "start":  
                        start(c);  
                        break;  
                    case "draw":  
                        draw(c);  
                        break;  
                    case "clear":  
                        clear();  
                        break;  
                    default:  
                        console.error("cette commande n'existe pas "+ c.command);  
                }  
                i++;  
                setTimeout(iterate,30);  
            };  
  
            iterate();  
  
        };  

    </script>  
    

    <canvas id="myCanvas"></canvas>  

<?php //include("footer.php"); ?>