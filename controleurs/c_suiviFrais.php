<?php
include("vues/v_sommairecomp.php");
$action = $_REQUEST['action'];
switch ($action) {
    case 'selectionnerFicheDeFrais': {
            $listeFiche = $pdo->ListeFicheValider();
            include("vues/v_listeFicheFrais.php");
            break;
        }

    case 'voirDetailFrais': {
            $laFiche = $_REQUEST['lstFiche']; 
            $split = explode("/", $laFiche); 
            $leMois = $split[0]; 
            $leVisiteur = $split[1]; 
            $_SESSION['mois'] = $leMois;
            $_SESSION['id'] = $leVisiteur;
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);

            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_suiviFrais.php");
            break;
        }

    case 'rembourserFiche': {
            $pdo->majEtatFicheFrais($_SESSION['id'], $_SESSION['mois'], 'RB');
            header('Location: index.php?uc=suiviFrais&action=selectionnerFicheDeFrais');
            break; 
        }
}
?>