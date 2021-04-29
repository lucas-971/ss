<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;
session_start();

$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();


if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");break;
	}
	case 'gererFrais' :{
		include("controleurs/c_gererFrais.php");break;
	}
	case 'etatFrais' :{
		include("controleurs/c_etatFrais.php");break; 
	}
        case 'validerfichefrais' :{
		include("controleurs/c_validerfichefrais.php");break; 
	}
        case 'suiviFrais' :{
		include("controleurs/c_suiviFrais.php");break; 
	}
	case 'suivrePaiement' :{
		include("controleurs/c_validerfichefrais.php");break; 
	}
	
	case 'choisirFichesPaiement' :{
		include("controleurs/c_validerfichefrais.php");break; 
	}
		case 'pdfAjout' :{
		/*
		$idVisiteur = isset($_REQUEST['lstVisiteurs']) ? $_REQUEST['lstVisiteurs'] : null;
		$leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;
		$fiche = pdoGsb::getLesInfosFicheFrais($idVisiteur,$leMois) ;
		$montantValide = $fiche['montantValide'] ;
		$fraisForfait = pdoGsb::getLesFraisForfait($idVisiteur,$leMois) ;
		$fraisHorsForfait = pdoGsb::getLesFraisHorsForfait($idVisiteur,$leMois) ;
		$leVisiteur = pdoGsb::getInfosVisiteur($idVisiteur) ; 
		*/
		include("controleurs/c_validerfichefrais.php");

		break; 
	}
}
include("vues/v_pied.php") ;
?>

