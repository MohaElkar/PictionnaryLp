<!DOCTYPE html>  
<html>  
    <head>  
        <meta charset=utf-8 />  
        <title>Pictionnary - Inscription</title>  
    </head>  
    
    <body>        
        <h2>Inscrivez-vous</h2>  
        
        <form class="inscription" action="req_inscription.php" method="post" name="inscription">  
            <span class="required_notification">Les champs obligatoires sont indiqués par *</span>  
            
            <ul>  
                <li>  
                    <label for="email">E-mail :</label>  
                    <input type="email" name="email" id="email" autofocus required/>  
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
                    <label for="bom">Nom :</label>  
                    <input type="text" name="nom" id="nom" placeholder="Votre nom"/> 
                </li>  

                <li>  
                    <label for="prenom">Prénom :</label>  
                    <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required/> 
                </li>  

                <li>  
                    <label for="telephone">Téléphone :</label>  
                    <input type="tel" name="telephone" id="telephone" /> 
                </li> 

                <li>  
                    <label for="site">Site web :</label>  
                    <input type="url" name="site" id="site" /> 
                </li>  

                <li>  
                    <label for="sexe">Sexe :</label>  
                    <input type="radio" name="sexe" value="Femme" /> Femme
                    <input type="radio" name="sexe" value="Homme" /> Homme
                </li>  
                
                <li>  
                    <label for="dateNaissance">Date naissance :</label>  
                    <input type="date" name="dateNaissance" id="dateNaissance" required /> 
                </li> 

                <li>  
                    <label for="age">Age :</label>  
                    <input type="number" name="age" id="age" disabled /> 
                </li>

                <li>  
                    <label for="ville">Ville :</label>  
                    <input type="text" name="ville" id="ville" /> 
                </li> 

                <li>  
                    <label for="taille">Taille :</label>  
                    <input type="range" name="taille" value="0" max="2.50" min="0" step="0.01">
                </li> 

                <li>  
                    <label for="color">Couleur préférée :</label>  
                    <input type="color" name="couleur" id="color" value="#000000">
                </li> 

                <li>  
                    <label for="photo">Photo de profil :</label>  
                    <input type="file" name="photo" id="photo" value="#000000">
                </li> 

                <li>  
                    <input type="submit" value="Soumettre Formulaire">  
                </li>  
            </ul> 

        </form>  

        <script type="text/javascript" src="misc/js/script.js"></script>
    </body>  
</html>  