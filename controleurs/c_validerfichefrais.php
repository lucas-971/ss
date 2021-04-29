<?php

include("vues/v_sommairecomp.php");

$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = $_REQUEST['action'];

switch ($action) {
    case 'choisirVisiteur': {
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $leMois = isset($_SESSION['lstMois']) ? $_SESSION['lstMois'] : null;
            $lesClesV = array_keys($lesVisiteurs);
            $visiteurASelectionner = $lesClesV[0];
            $lastSixMonth = getLesSixDerniersMois();
            include("vues/v_listevisiteur.php");
            break;
        }

    case 'fiche': {

            $lesVisiteurs = $pdo->getLesVisiteurs();
            $lesClesV = array_keys($lesVisiteurs);
            $visiteurASelectionner = $lesClesV[0];
            $lastSixMonth = getLesSixDerniersMois();
            $idVisiteur = isset($_REQUEST['lstVisiteurs']) ? $_REQUEST['lstVisiteurs'] : null;
            $leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;
            if ($idVisiteur && $leMois) {
                $_SESSION['idVisiteur'] = $idVisiteur;
                $_SESSION['lstMois'] = $leMois;
                $idVisiteur = $_SESSION['idVisiteur'];
                $leMois = $_SESSION['lstMois'];
            }
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            include("vues/v_listevisiteur.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_listefiche.php");
            break;
        }

    case 'modification': {
            $leMois = isset($_SESSION['lstMois']) ? $_SESSION['lstMois'] : null;
            $lesFrais = $_REQUEST['lesFrais'];
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
            break;
        }

    case 'supprimer': {
            $id = $_REQUEST['id'];
            $pdo->refuserfrais($id);
            header('Location: index.php?uc=validerfichefrais&action=fiche');
            break;
        }

    case 'reporter': {
            $id = $_REQUEST['id'];
            $MoisPlus = getMoisNext($numAnnee, substr($_SESSION['lstMois'], 4, 2)); 
            var_dump($MoisPlus);
            var_dump($idVisiteur);
            $pdo->creeNouvellesLignesFrais($idVisiteur, $MoisPlus);
            $req = "UPDATE `lignefraisforfait` SET `mois`='" . $MoisPlus . "' WHERE `idVisiteur`='" . $idVisiteur . "' and `idFraisForfait`='" . $id . "'";
            break;
        }


   case 'pdfAjout':{
    $idVisiteur = $_REQUEST['visiteur'];
    /* $idVisiteur = isset($_REQUEST['lstVisiteurs']) ? $_REQUEST['lstVisiteurs'] : null;*/
    /* $idVisiteur = $_REQUEST['lstVisiteurs']; */
     $leMois = $_REQUEST['mois']; 
    /* $leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;*/   
    
     $fiche = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois) ;
     $montantValide = $fiche['montantValide'] ;
    /* $internaute = $pdo->getInfosinternet($login,$mdp);*/
     $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois) ;
     $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois) ;
     $visiteur = $pdo->getInfosVisiteur($idVisiteur) ; 

     include("vues/ajoutPdf.php");
   

     break;   
       }


































    case 'choisirFichesPaiement':{
	
		$lesFiches = $pdo->getLesInfosFicheFraisVA_MP();
                
                include("vues/v_listeFicheValide.php");
                
		break;
	}
        
        
    case 'Payer':{
           if (isset($_POST["rb"]))    
           {
           foreach ($_POST["payer"] as $index => $value)
                    
                    {
   $tab = explode(";",$value);
   $idVisiteur = $tab[0];
   $mois = $tab[1] ;
   $etat = $tab[2];
         if($etat=='VA')
   $pdo->majEtatFicheFrais($idVisiteur,$mois,'MP');
         else
   $pdo->majEtatFicheFrais($idVisiteur,$mois,'RB');       
                   }    
        $lesFiches = $pdo->getLesInfosFicheFraisMP();         
        include("vues/v_listeFicheValide.php");   
           }
           else
           {
                
		echo "aucun visiteur rentre" ;
            }  
        break;
       } 
       
    
            
}

?>