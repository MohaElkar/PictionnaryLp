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