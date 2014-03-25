<?php

/**
 * Rechercher
 * 
 * Action qui permet de rechercher un événement (etat niveauConnection_consultationResultatRecherche)
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Modele"];
include $models["Adresse"];
include $models["Evenement"];

$motCle = filter_input(INPUT_POST, 'motCle');

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

$monEtat = definirNiveauDeConnexion($_SESSION['state']);

// On récupère les informations pour l'ensemble des événements
$evenement = new Evenement();
$listEvenement = $evenement->getListEventSearched($motCle);

foreach ($listEvenement as $idEvent) {
    $infosEvent[$idEvent] = $evenement->getInfosEventVignette($idEvent);
}

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state']=$niveauConnexion.'_consultationResultatRecherche';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - Accueil";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuNonConnecte'];
$dataView['zoneCentrale']=$views['accueil'];
$dataView['css']=$css['stylePrincipal'];
$dataView['infosEvent'] = $infosEvent;
// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  
