<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'demandeConnexion': {
            include("vues/v_connexion.php");
            break;
        }
    case 'valideConnexion': {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
             $comptable = $pdo->getInfosInternaute($login, $mdp);
             $visiteur = $pdo->getInfosInternaute($login, $mdp);
            $internaute = $pdo->getInfosInternaute($login, $mdp);

            if (!is_array($comptable)) {
                ajouterErreur("Login ou mot de passe incorrect");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
            } elseif ($comptable['type'] == "visiteur") {
                $type = $comptable['type'];
                $id = $comptable['id'];
                $nom = $comptable['nom'];
                $prenom = $comptable['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommaire.php");
            } else {
                $type = $visiteur['type'];
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommairecomp.php");
            }
        }break;

    case "deconnexion": {
            deconnecter();
            include("vues/v_connexion.php");
            break;
        }
    default : {
            include("vues/v_connexion.php");
            break;
        }
}
?>