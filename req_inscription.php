<?php
    include("PDOConnexion.php");

    // récupérer les éléments du formulaire
    // et se protéger contre l'injection MySQL (plus de détails ici: http://us.php.net/mysql_real_escape_string)
    $email      = stripslashes($_POST['email']);
    $password   = stripslashes($_POST['password']);
    $nom        = stripslashes($_POST['nom']);
    $prenom     = stripslashes($_POST['prenom']);
    $tel        = stripslashes($_POST['tel']);
    $website    = stripslashes($_POST['website']);
    $sexe       = '';
    if (array_key_exists('sexe',$_POST)) {
        $sexe   =stripslashes($_POST['sexe']);
    }
    $birthdate  = stripslashes($_POST['birthdate']);
    $ville      = stripslashes($_POST['ville']);
    $taille     = stripslashes($_POST['taille']);
    $couleur    = stripslashes($_POST['couleur']);
    $profilepic = stripslashes($_POST['profilepic']);

    try {
        // Connect to server and select database.
        //$dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
        $dbh = PDOConnexion::getInstance();

        // Vérifier si un utilisateur avec cette adresse email existe dans la table.
        // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
        $sql = $dbh->prepare("select email from users where email = :email");
        $sql->bindValue(":email", $email);    
        $sql->execute();
        
        if ( $sql->rowCount() >=1) {
            header("Location: inscription.php?erreur=".urlencode("L'adresse email existe déjà")
                ."&email=".htmlspecialchars($_POST['email'])
                ."&nom=".htmlspecialchars($_POST['nom'])
                ."&prenom=".htmlspecialchars($_POST['prenom'])
                ."&tel=".htmlspecialchars($_POST['tel'])
                ."&website=".htmlspecialchars($_POST['website'])
                ."&sexe=".htmlspecialchars($_POST['sexe'])
                ."&birthdate=".htmlspecialchars($_POST['birthdate'])
                ."&ville=".htmlspecialchars($_POST['ville'])
                ."&taille=".htmlspecialchars($_POST['taille'])
                ."&couleur=".htmlspecialchars($_POST['couleur'] )
                ."&profilepic=".htmlspecialchars($_POST['profilepic'] )
            );

            exit();
        }
        else {
            // Tenter d'inscrire l'utilisateur dans la base
            $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) " . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");
            
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password",    $password);
            $sql->bindValue(":prenom",      (empty($prenom))        ? NULL : $prenom);
            $sql->bindValue(":nom",         (empty($nom))           ? NULL : $nom);
            $sql->bindValue(":website",     (empty($website))       ? NULL : $website);
            $sql->bindValue(":ville",       (empty($ville))         ? NULL : $ville);
            $sql->bindValue(":tel",         (empty($tel))           ? NULL : $tel);
            $sql->bindValue(":taille",      (empty($taille))        ? NULL : $taille);
            $sql->bindValue(":profilepic",  (empty($profilepic))    ? NULL : $profilepic);
            $sql->bindValue(":birthdate",   (empty($birthdate))     ? NULL : $birthdate);
            $sql->bindValue(":couleur",     str_replace("#", "", $couleur) ); // On formate la couleur. On supprime le "#".
            $sql->bindValue(":sexe",        ($sexe === 'H' || $sexe === 'F') ? $sexe : '');

            // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
            if (!$sql->execute()) {
                echo "PDO::errorInfo():<br/>";
                $err = $sql->errorInfo();
                print_r($err);
            } else {

                // ici démarrer une session
                session_start();

                // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit, et 
                $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");
                if ($sql->rowCount()<1) {
                    header("Location: main.php?erreur=".urlencode("un problème est survenu"));
                }
                else {
                    // on récupère la ligne qui nous intéresse avec $sql->fetch(), 
                    $res = $sql->fetch();

                    // et on enregistre les données dans la session avec $_SESSION["..."]=...
                    $_SESSION["id"]         = $res["id"];
                    $_SESSION["email"]      = $res["email"];
                    $_SESSION["nom"]        = $res["nom"];
                    $_SESSION["prenom"]     = $res["prenom"];
                    $_SESSION["couleur"]    = $res["couleur"];
                    $_SESSION["profilepic"] = $res["profilepic"];
                }

                // ici,  rediriger vers la page main.php
                header("Location: main.php");
            }
            $dbh = null;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        $dbh = null;
        die();
    }
?>