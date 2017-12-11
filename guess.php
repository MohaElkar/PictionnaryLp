<?php  
    include "header.php";  

    if (!isset($_SESSION['id'])){
        header("Location: error.php?erreur=".urlencode("Veuillez vous connecter"));  
        exit();
    } 
    else 
    {          
        $commands = "";

        try {
            // Connexion à la base de donné.
            $dbh = PDOConnexion::getInstance();
            // On récupère les commandes du dessin X associé à l'utilisateur Y.           
            $req = $dbh->executer("SELECT commande from drawings where id = :id and id_user = :id_user", array( ':id' => $_GET["id"], ':id_user' => $_SESSION["id"]) );          

            // La requête doit nous retourner un élément.
            if ( $req->rowCount() === 1) {
               $commands = $req->fetch()[0];
            }
            
            $dbh = null;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            $dbh = null;
            die();
        }
    }  
?>  

    <canvas id="myCanvas"></canvas>  

    <script type="text/javascript">
        var size, color;                                // la taille et la couleur du pinceau    
        var x0, y0;                                     // la dernière position du stylo  
        var drawingCommands = <?php echo $commands;?>;  // On récupère les commandes.
        
        window.onload = function() {  
            var canvas = document.getElementById('myCanvas');  
            canvas.width = 400;  
            canvas.height= 400;  
            var context = canvas.getContext('2d');  
        
            var start = function(c) {  
                context.beginPath();
                context.arc(c.x, c.y, c.taille, 0, 2 * Math.PI, false);
                context.fillStyle = c.color;
                context.fill();
            }  
        
            var draw = function(c) {  
                context.lineWidth = c.taille;
                context.fillStyle = c.color
                context.lineTo(c.x, c.y);
                context.strokeStyle = c.color;
                context.stroke();          
            }  
        
            var clear = function() {  
                context.clearRect(0,0,canvas.width, canvas.height); 
            }  
        
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

<?php include("footer.php"); ?>