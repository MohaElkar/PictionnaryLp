# PictionnaryLp

![SCREENSHOT](https://raw.githubusercontent.com/MohaElkar/PictionnaryLp/master/screenshot/screen.png)

## Partie 1: Application Pictionnary

Lien: 
```
http://miageprojet2.unice.fr/index.php?title=User:Max/LPSIL_IDSE_-_Web_Multim%C3%A9dia_%2F%2F_Web_S%C3%A9mantique/Partie_1:_Application_Pictionnary&highlight=pictionnary
```

### Questions page inscription :

* À Quoi Ressemble Un <Head> Propre?
```
<head>
	<title>Mon titre</title>
</head>	
```

* C'est quoi les attributs action et method ?
	* L'attribut "action" permet d'indiquer la page qui se chargera du traitement des données.
	* L'attribut "method" permet d'indiquer la façon dont les données seront envoyés (POST, GET...). 

* Qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ?
	* Il existe les "method" POST, GET 

* Quelle est la différence entre les attributs name et id ? 
    * L'attribut "id" permet d'identifier l'input dans le DOM.
    * L'attribut "name" va permettre d'identifier le champs et sera utile pour récupérer les informations dans une page de traitement.
 
* C'est lequel qui doit être égal à l'attribut for du label ? 
	* C'est l'identifiant "id" qui doit être égal à l'attribut for du label.


### Question champ mdp1 :

* Quels sont les deux scénarios où l'attribut title sera affiché ?   
    * Tant que la valeur renseigné ne respecte pas l'expression régulière et lors du survole sur l'input. 
    Le survole au dessus de l'input affichera le title.

* Encore une fois, quelle est la différence entre name et id pour un input ?  
    * L'attribut "id" permet d'identifier l'input dans le DOM.
    * L'attribut "name" va permettre d'identifier le champs et sera utile pour récupérer les informations dans une page de traitement.

### Question champ mdp2 :

* Pourquoi est-ce qu'on a pas mis un attribut name ici ?
	* Car ce champ n'est pas utilise coté traitement (serveur).

* Quel scénario justifie qu'on ait ajouté l'écouter validateMdp2() à l'évènement onkeyup de l'input mdp1 ?
	* Si mdp2 est renseigné et que l'utisateur modifie sans le faire expret le mdp1 alors il faut vérifier que le mot de passe 2 corresponds. 

### Question champ date naissance :

* A quoi sert l'attribut disabled ?
	* Il permet de rendre le champs read only. C-a-d qu'on ne peux pas modifier sa valeur.

### Dessiner et redessiner / page paint.php
* A quoi servent ces champs hidden ? 
	* Ils permettent de passer des informations à la page de traitement sans pour autant les afficher à l'écran. 
