<?php include("header.php"); ?> 

    <h2>Inscrivez-vous</h2>

    <?php // Si le paramete GET erreur est detecté on affiche une alerte.
        if (isset($_GET["erreur"]) && !empty($_GET["erreur"])): 
    ?>
        <div class="alert alert-danger"> <?php echo($_GET["erreur"]); ?> </div>
    <?php endif; ?>
    
    <form class="inscription" action="req_inscription.php" method="post" name="inscription">  
        <span class="required_notification">Les champs obligatoires sont indiqués par *</span>  
        
        <ul>  
            <li>  
                <label for="email">E-mail :</label>  
                <input type="email" name="email" id="email" autofocus required value="<?php echo isset($_GET['email']) ? $_GET['email'] : "" ?>"/>  
                <span class="form_hint">Format attendu "name@something.com"</span>  
            </li>  
            
           <li>  
                <label for="mdp1">Mot de passe :</label>  
                <input type="password" name="password" id="mdp1" required placeholder="Mot de passe." pattern="[a-zA-Z0-9]{6,8}" onkeyup="validateMdp2()" title="Le mot de passe doit contenir de 6 à 8 caractères alphanumériques.">  
                <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>  
            </li> 

            <li>  
                <label for="mdp2">Confirmez mot de passe :</label>  
                <input type="password" id="mdp2" required onkeyup="validateMdp2()" required placeholder="Vérification mot de passe.">  
                <span class="form_hint">Les mots de passes doivent être égaux.</span>  
            </li>

            <li>  
                <label for="nom">Nom :</label>  
                <input type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : "" ?>"/> 
            </li>  

            <li>  
                <label for="prenom">Prénom :</label>  
                <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required value="<?php echo isset($_GET['prenom']) ? $_GET['prenom'] : "" ?>"/> 
            </li>  

            <li>  
                <label for="telephone">Téléphone :</label>  
                <input type="tel" name="tel" id="telephone" value="<?php echo isset($_GET['tel']) ? $_GET['tel'] : "" ?>" /> 
            </li> 

            <li>  
                <label for="site">Site web :</label>  
                <input type="url" name="website" id="site" value="<?php echo isset($_GET['website']) ? $_GET['website'] : "" ?>"/> 
            </li>  

            <li>  
                <label for="sexe">Sexe :</label>  
                <input type="radio" name="sexe" value="F" <?php echo isset($_GET['sexe']) && $_GET["sexe"] == 'F' ? "checked" : "" ?> /> Femme
                <input type="radio" name="sexe" value="H" <?php echo isset($_GET['sexe']) && $_GET["sexe"] == 'H' ? "checked" : "" ?> /> Homme
            </li>  
            
            <li>  
                <label for="birthdate">Date de naissance:</label>  
                <input type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" required onchange="computeAge()" value="<?php echo isset($_GET['birthdate']) ? $_GET['birthdate'] : "" ?>"/>  
                <span class="form_hint">Format attendu "JJ/MM/AAAA"</span>  
            </li>  
                
            <li>  
                <label for="age">Age:</label>  
                <input type="number" name="age" id="age" disabled />  
                <!-- à quoi sert l'attribut disabled ? -->  
            </li>  

            <li>  
                <label for="ville">Ville :</label>  
                <input type="text" name="ville" id="ville" value="<?php echo isset($_GET['ville']) ? $_GET['ville'] : "" ?>" /> 
            </li> 

            <li>  
                <label for="taille">Taille :</label>  
                <input type="range" name="taille" max="2.50" min="0" step="0.01" value="<?php echo isset($_GET['taille']) ? $_GET['taille'] : 0 ?>">
            </li> 

            <li>  
                <label for="color">Couleur préférée :</label>  
                <input type="color" name="couleur" id="color" value="#000000" value="<?php echo isset($_GET['couleur']) ? $_GET['couleur'] : "#000000" ?>">
            </li> 

            <li>  
                <label for="profilepicfile">Photo de profil:</label>  
                <input type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>  
                <!-- l'input profilepic va contenir le chemin vers l'image sur l'ordinateur du client -->  
                <!-- on ne veut pas envoyer cette info avec le formulaire, donc il n'y a pas d'attribut name -->  
                <span class="form_hint">Choisissez une image.</span>  
                <input type="hidden" name="profilepic" id="profilepic"/>  
                <!-- l'input profilepic va contenir l'image redimensionnée sous forme d'une data url -->   
                <!-- c'est cet input qui sera envoyé avec le formulaire, sous le nom profilepic -->  
                <canvas id="preview" width="0" height="0" style="border:1px solid #000000;"></canvas>  
                <!-- le canvas (nouveauté html5), c'est ici qu'on affichera une visualisation de l'image. -->  
                <!-- on pourrait afficher l'image dans un élément img, mais le canvas va nous permettre également   
                de la redimensionner, et de l'enregistrer sous forme d'une data url-->             
            </li> 

            <li>  
                <input type="submit" value="Soumettre Formulaire">  
            </li>  
        </ul> 

    </form>  

<?php include("footer.php"); ?> 