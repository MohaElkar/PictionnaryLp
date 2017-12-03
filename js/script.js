// Validation mot de passe.
validateMdp2 = function(e) {  
    var mdp1 = document.getElementById('mdp1');  
    var mdp2 = document.getElementById('mdp2');  
    
    if ( (mdp1.value.match("[a-zA-Z0-9]{6,8}") !== null) && (mdp1.value === mdp2.value) ) {  
        // ici on supprime le message d'erreur personnalisé, et du coup mdp2 devient valide.  
        document.getElementById('mdp2').setCustomValidity('');  
    } else {  
        // ici on ajoute un message d'erreur personnalisé, et du coup mdp2 devient invalide.  
        document.getElementById('mdp2').setCustomValidity('Les mots de passes doivent être égaux.');  
    }  
} 

// Calcule age.
computeAge = function(e) {  
    var divAge = document.getElementById('age');
    
    try{  
        // Différence entre timestamp aujourdhui et timestamp de l'input.
        var diff = Date.now() - Date.parse(document.getElementById("birthdate").valueAsDate);

        divAge.value = new Date(diff).getYear() -70;
    } catch(e) {  
        divAge.value = null;
    }  
}

// Photo de profil.
loadProfilePic = function (e) { 

    // on récupère le canvas où on affichera l'image  
    var canvas = document.getElementById("preview");  
    var ctx = canvas.getContext("2d");  

    // on réinitialise le canvas: on l'efface, et déclare sa largeur et hauteur à 0  
    ctx.fillStyle="#FF0000";
    ctx.fillRect(0,0,canvas.width,canvas.height); 
    canvas.width=0;  
    canvas.height=0;  

    // on récupérer le fichier: le premier (et seul dans ce cas là) de la liste  
    var file = document.getElementById("profilepicfile").files[0];  
    
    // l'élément img va servir à stocker l'image temporairement  
    var img = document.createElement("img");  

    // l'objet de type FileReader nous permet de lire les données du fichier.  
    var reader = new FileReader();  
    
    // on prépare la fonction callback qui sera appelée lorsque l'image sera chargée  
    reader.onload = function(e) {  
        //on vérifie qu'on a bien téléchargé une image, grâce au mime type  
        if (!file.type.match(/image.*/)) {    
            // le fichier choisi n'est pas une image: le champs profilepicfile est invalide, et on supprime sa valeur  
            document.getElementById("profilepicfile").setCustomValidity("Il faut télécharger une image.");  
            document.getElementById("profilepicfile").value = "";  
        }  
        else {
            // le callback sera appelé par la méthode getAsDataURL, donc le paramètre de callback e est une url qui contient   
            // les données de l'image. On modifie donc la source de l'image pour qu'elle soit égale à cette url  
            // on aurait fait différemment si on appelait une autre méthode que getAsDataURL.  
            img.src = e.target.result; 
            
            // le champs profilepicfile est valide  
            document.getElementById("profilepicfile").setCustomValidity("");  
            var MAX_WIDTH = 96;  
            var MAX_HEIGHT = 96;  
            var width = img.width;  
            var height = img.height;  
            // A FAIRE: si on garde les deux lignes suivantes, on rétrécit l'image mais elle sera déformée  
            // Vous devez supprimer ces lignes, et modifier width et height pour:  
            //    - garder les proportions,   
            //    - et que le maximum de width et height soit égal à 96  
            var width = MAX_WIDTH;  
            var height = MAX_HEIGHT;  
              
            canvas.width = width;  
            canvas.height = height;  
            // on dessine l'image dans le canvas à la position 0,0 (en haut à gauche)  
            // et avec une largeur de width et une hauteur de height  
            ctx.drawImage(img, 0, 0, width, height);  
            // on exporte le contenu du canvas (l'image redimensionnée) sous la forme d'une data url  
            var dataurl = canvas.toDataURL("image/png");  
            // on donne finalement cette dataurl comme valeur au champs profilepic  
            document.getElementById("profilepic").value = dataurl;  
        };  
    }  
    // on charge l'image pour de vrai, lorsque ce sera terminé le callback loadProfilePic sera appelé.  
    reader.readAsDataURL(file);  
}  


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