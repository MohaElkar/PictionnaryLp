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
                    <label for="mdp">Mot de passe :</label>  
                    <input type="password" name="mdp" id="mdp" placeholder="Votre prénom" required/>    
                </li> 

                <li>  
                    <label for="mdp">Mot de passe :</label>  
                    <input type="password" name="mdp" id="mdp" placeholder="Votre prénom" required/>    
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
    </body>  
</html>  