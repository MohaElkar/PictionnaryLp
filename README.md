# PictionnaryLp

http://miageprojet2.unice.fr/index.php?title=User:Max/LPSIL_IDSE_-_Web_Multim%C3%A9dia_%2F%2F_Web_S%C3%A9mantique/Partie_1:_Application_Pictionnary&highlight=pictionnary

// Questions page inscription :

- c'est quoi les attributs action et method ?
	L'attribut "action" permet d'indiquer la page qui se chargera du traitement des données inscrit par l'utilisateur.
	L'attribut "method" permet d'indiquer la facon dont les données seront envoyé. 

- qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ?
	Il existe la "method" POST, GET, PUT 

- quelle est la différence entre les attributs name et id ? 
    "id" permet de d'identifier l'input dans le DOM.
    "name" permet de nommer le champs. La valueur de cette input sera accessible grace au "name" depuis php par exemple. Elle permet d'identifier le champs.
 
- c'est lequel qui doit être égal à l'attribut for du label ? 
	C'est l'identifiant qui doit être égal à l'attribut for du label.


// Question champ mdp1 :
    <!-- quels sont les deux scénarios où l'attribut title sera affiché ? -->  
    Tant que la valeur renseigné ne respecte pas la regex et lors du survole sur linput
    <!-- encore une fois, quelle est la différence entre name et id pour un input ? -->  
    "id" permet de d'identifier l'input dans le DOM.
    "name" permet de nommer le champs. La valueur de cette input sera accessible grace au "name" depuis php par exemple. Elle permet d'identifier le champs.

// Question champ mdp2 :
- pourquoi est-ce qu'on a pas mis un attribut name ici ?
	Car ce champ n'est pas utilise coté serveur.

- quel scénario justifie qu'on ait ajouté l'écouter validateMdp2() à l'évènement onkeyup de l'input mdp1 ?
	Pour permettre de valider l'input à chaque modification de l'input. 

// Question champ date naissance :
- à quoi sert l'attribut disabled ?
	Il permet de rendre le champs read only. Cad que on ne peut pas modifier sa valeur.

// Dessiner et redessiner / page paint.php
- à quoi servent ces champs hidden ? 
	Ils permettent de passer des informations à la requete POST du formulaire sans pour autant les afficher à l'ecran. 
