<?php
    include("class/PDOConnexion.php");

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
        // Connexion à la base de donné.
        $dbh = PDOConnexion::getInstance();
        // Vérifier si un utilisateur avec cette adresse email existe dans la table.
        $req = $dbh->executer("select email from users where email = :email", array( ':email' => $email) );          

        // Un utilisateur existe deja avec la meme adresse email.
        if ( $req->rowCount() >=1) {
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
            $req = $dbh->executer("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) " . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)", 
                array( 
                    ':email'        => $email,
                    ':password'     => $password,
                    ':prenom'       => (empty($prenom)) ? NULL : $prenom,
                    ":nom"          => (empty($nom))           ? NULL : $nom,
                    ":website"      => (empty($website))       ? NULL : $website,
                    ":ville"        => (empty($ville))         ? NULL : $ville,
                    ":tel"          => (empty($tel))           ? NULL : $tel,
                    ":taille"       => (empty($taille))        ? NULL : $taille,
                    ":profilepic"   => (empty($profilepic))    ? NULL : $profilepic,
                    ":birthdate"    => (empty($birthdate))     ? NULL : $birthdate,
                    ":couleur"      => str_replace("#", "", $couleur) ,
                    ":sexe"         => ($sexe === 'H' || $sexe === 'F') ? $sexe : ''
                ) 
            );          

            // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
            if (!$req) {
                echo "PDO::errorInfo():<br/>";
                $err = $req->errorInfo();
                print_r($err);
            } else {

                // ici démarrer une session
                session_start();

                // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit, et 
                $req = $dbh->executer("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'" );          

                if ($req->rowCount()<1) {
                    header("Location: error.php?erreur=".urlencode("un problème est survenu"));
                }
                else {
                    // on récupère la ligne qui nous intéresse avec $sql->fetch(), 
                    $res = $req->fetch();

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