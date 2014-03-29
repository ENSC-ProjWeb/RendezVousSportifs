<?php

/**
 * Initialiser
 * 
 * Action qui initialise la page d'accueil (etat nonConnecte_accueil)
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * @todo: Tout va bien
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Modele"];
include $models["Sport"];
include $models["Adresse"];
include $models["Evenement"];

$infosEvent = array();
$sport = new Sport();

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// On nettoie les variables de session
$_SESSION=array();

// On récupère les informations pour l'ensemble des événements
$evenement = new Evenement();
$listEvenement = $evenement->getListEvent();

foreach ($listEvenement as $idEvent) {
    $infosEvent[$idEvent] = $evenement->getInfosEventVignette($idEvent);
}

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state']='nonConnecte_accueil';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - Accueil";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuNonConnecte'];
$dataView['zoneCentrale']=$views['consultationListeEvenements'];
$dataView['css']=$css['stylePrincipal'];
$dataView['infosEvent'] = $infosEvent;
$dataView['listeSports'] = $sport->getFiveTopSports();
// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  
