<!DOCTYPE html>  
<html>  
<head>  
    <meta charset=utf-8 />  
    <title>Pictionnary - Inscription</title>  
</head>  
<body>  
  
<h2>Inscrivez-vous</h2>  
<form class="inscription" action="req_inscription.php" method="post" name="inscription">  
    <!-- c'est quoi les attributs action et method ?
        L'attribut "action" permet d'indiquer la page qui se chargera du traitement des données inscrit par l'utilisateur.
        L'attribut "method" permet d'indiquer la facon dont les données seront envoyé. 
    -->  
    <!-- qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ?
        Il existe la "method" POST, GET, PUT 
     -->  
    <span class="required_notification">Les champs obligatoires sont indiqués par *</span>  
    <ul>  
        </li>  
        <li>  
            <label for="email">E-mail :</label>  
            <input type="email" name="email" id="email" autofocus required/>  
            <!-- ajouter à input l'attribut qui lui donne le focus automatiquement -->  
            <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->  
            <!-- quelle est la différence entre les attributs name et id ? 
                "id" permet de d'identifier l'input dans le DOM.
                "name" permet de nommer le champs. La valueur de cette input sera accessible grace au "name" depuis php par exemple. Elle permet d'identifier le champs.
            -->  
            <!-- c'est lequel qui doit être égal à l'attribut for du label ? 
                C'est l'identifiant qui doit être égal à l'attribut for du label.
            -->   
            <span class="form_hint">Format attendu "name@something.com"</span>  
        </li>  
        <li>  
            <label for="prenom">Prénom :</label>  
            <input type="text" name="prenom" id="prenom" required placeholder="Votre prénom"/>  
            <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->  
            <!-- ajouter à input l'attribut qui donne une indication grisée (placeholder) -->  
        </li>  
        
        <li>  
            <label for="mdp">Mot de passe :</label>  
            <input type="password" name="mdp" id="mdp" required placeholder="Votre prénom"/>    
        </li> 

        <li>  
            <input type="submit" value="Soumettre Formulaire">  
        </li>  
    </ul>  
</form>  
</body>  
</html>  