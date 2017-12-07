<?php include("header.php"); ?> 

    <h2>Inscrivez-vous</h2>

    <?php // Si le paramete GET erreur est detecté on affiche une alerte.
        if (isset($_GET["erreur"]) && !empty($_GET["erreur"])): 
    ?>
        <div class="alert alert-danger"> <?php echo($_GET["erreur"]); ?> </div>
    <?php endif; ?>
 
 <div class="row">
        <div class="col-lg-12">
            <form class="inscription" action="req_inscription.php" method="post" name="inscription">  
                <span class="required_notification">Les champs obligatoires sont indiqués par *</span>  
                
                <ul>  
                    <li>  
                        <label for="email">E-mail :</label>  
                        <input class="form-control" type="email" name="email" id="email" autofocus required value="<?php echo isset($_GET['email']) ? $_GET['email'] : "" ?>"/>  
                        <span class="form_hint">Format attendu "name@something.com"</span>  
                    </li>  
                    
                   <li>  
                        <label for="mdp1">Mot de passe :</label>  
                        <input class="form-control" type="password" name="password" id="mdp1" required placeholder="Mot de passe." pattern="[a-zA-Z0-9]{6,8}" onkeyup="validateMdp2()" title="Le mot de passe doit contenir de 6 à 8 caractères alphanumériques.">  
                        <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>  
                    </li> 

                    <li>  
                        <label for="mdp2">Confirmez mot de passe :</label>  
                        <input class="form-control" type="password" id="mdp2" required onkeyup="validateMdp2()" required placeholder="Vérification mot de passe.">  
                        <span class="form_hint">Les mots de passes doivent être égaux.</span>  
                    </li>

                    <li>  
                        <label for="nom">Nom :</label>  
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : "" ?>"/> 
                    </li>  

                    <li>  
                        <label for="prenom">Prénom :</label>  
                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Votre prénom" required value="<?php echo isset($_GET['prenom']) ? $_GET['prenom'] : "" ?>"/> 
                    </li>  

                    <li>  
                        <label for="telephone">Téléphone :</label>  
                        <input class="form-control" type="tel" name="tel" id="telephone" value="<?php echo isset($_GET['tel']) ? $_GET['tel'] : "" ?>" /> 
                    </li> 

                    <li>  
                        <label for="site">Site web :</label>  
                        <input class="form-control" type="url" name="website" id="site" value="<?php echo isset($_GET['website']) ? $_GET['website'] : "" ?>"/> 
                    </li>  

                    <li>  
                        <label for="sexe">Sexe :</label>  
                        <input type="radio" name="sexe" value="F" <?php echo isset($_GET['sexe']) && $_GET["sexe"] == 'F' ? "checked" : "" ?> /> Femme
                        <input type="radio" name="sexe" value="H" <?php echo isset($_GET['sexe']) && $_GET["sexe"] == 'H' ? "checked" : "" ?> /> Homme
                    </li>  
                    
                    <li>  
                        <label for="birthdate">Date de naissance:</label>  
                        <input class="form-control" type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" required onchange="computeAge()" value="<?php echo isset($_GET['birthdate']) ? $_GET['birthdate'] : "" ?>"/>  
                        <span class="form_hint">Format attendu "JJ/MM/AAAA"</span>  
                    </li>  
                        
                    <li>  
                        <label for="age">Age:</label>  
                        <input class="form-control" type="number" name="age" id="age" disabled />  
                        <!-- à quoi sert l'attribut disabled ? -->  
                    </li>  

                    <li>  
                        <label for="ville">Ville :</label>  
                        <input class="form-control" type="text" name="ville" id="ville" value="<?php echo isset($_GET['ville']) ? $_GET['ville'] : "" ?>" /> 
                    </li> 

                    <li>  
                        <label for="taille">Taille :</label>  
                        <input class="form-control" type="range" name="taille" max="2.50" min="0" step="0.01" value="<?php echo isset($_GET['taille']) ? $_GET['taille'] : 0 ?>">
                    </li> 

                    <li>  
                        <label for="color">Couleur préférée :</label>  
                        <input class="form-control" type="color" name="couleur" id="color" value="#000000" value="<?php echo isset($_GET['couleur']) ? $_GET['couleur'] : "#000000" ?>">
                    </li> 

                    <li>  
                        <label for="profilepicfile">Photo de profil:</label>  
                        <input class="form-control" type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>  
                        <!-- l'input profilepic va contenir le chemin vers l'image sur l'ordinateur du client -->  
                        <!-- on ne veut pas envoyer cette info avec le formulaire, donc il n'y a pas d'attribut name -->  
                        <span class="form_hint">Choisissez une image.</span>  
                        
                        <input type="hidden" name="profilepic" id="profilepic"/>
                        <img  style="display: none;" id="tmpProfilePic"/>  
                        <!-- l'input profilepic va contenir l'image redimensionnée sous forme d'une data url -->   
                        <!-- c'est cet input qui sera envoyé avec le formulaire, sous le nom profilepic -->  
                        <canvas id="preview" width="0" height="0" style="border:1px solid #000000;"></canvas>  
                        <!-- le canvas (nouveauté html5), c'est ici qu'on affichera une visualisation de l'image. -->  
                        <!-- on pourrait afficher l'image dans un élément img, mais le canvas va nous permettre également   
                        de la redimensionner, et de l'enregistrer sous forme d'une data url-->             
                    </li> 

                    <li>  
                        <input type="submit" class="btn btn-success" value="Soumettre Formulaire">  
                    </li>  
                </ul> 
            </form>  
        </div>
 </div>   
    
<script type="text/javascript">
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
        ctx.setColoro="#FF0000";
        ctx.fillRect(0,0,canvas.width,canvas.height); 
        canvas.width=0;  
        canvas.height=0;  

        // on récupérer le fichier: le premier (et seul dans ce cas là) de la liste  
        var file = document.getElementById("profilepicfile").files[0];  
        
        // l'élément img va servir à stocker l'image temporairement  
        // var img = document.createElement("img");  

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
            else 
            {
                var type = file.type;
                // le callback sera appelé par la méthode getAsDataURL, donc le paramètre de callback e est une url qui contient   
                // les données de l'image. On modifie donc la source de l'image pour qu'elle soit égale à cette url  
                // on aurait fait différemment si on appelait une autre méthode que getAsDataURL.  
                var img = document.getElementById('tmpProfilePic');
                img.src = e.target.result;

                // On met la valeur à l'input pour le bon fonctionnement du formulaire.
                document.getElementById('profilepic').value = img.src;
                
                // le champs profilepicfile est valide  
                document.getElementById("profilepicfile").setCustomValidity("");  

                var MAX_WIDTH = 96;  
                var MAX_HEIGHT = 96;  

                var width = MAX_WIDTH;  
                var tmp = img.width/MAX_WIDTH;
                var height = img.height/tmp;

                canvas.width = width;  
                canvas.height = height;

                // on dessine l'image dans le canvas à la position 0,0 (en haut à gauche)  
                // et avec une largeur de width et une hauteur de height  
               /* var imgee*/
                setTimeout(function(){
                    ctx.drawImage(img, 0, 0,  width, height); 
                }, 1000);
                
                // on exporte le contenu du canvas (l'image redimensionnée) sous la forme d'une data url  
                var dataurl = canvas.toDataURL(type);  

                // on donne finalement cette dataurl comme valeur au champs profilepic  
                document.getElementById("profilepic").value = img.src;  
            };  
        }  

        // on charge l'image pour de vrai, lorsque ce sera terminé le callback loadProfilePic sera appelé.  
        reader.readAsDataURL(file);  
    }  
</script>

<?php include("footer.php"); ?> 