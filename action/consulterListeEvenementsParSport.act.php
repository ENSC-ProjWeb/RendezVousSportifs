<?php

/**
 * Consulter liste d'événements par sport
 * 
 * Action qui permet de consulter la liste d'événements par sport
 * 
 * 
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Modele"];
include $models["Sport"];
include $models["Adresse"];
include $models["Evenement"];

$idSport = filter_input(INPUT_GET, 'idSport'); // il s'agit du nom du sport
$sport = new Sport();
// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

$niveauConnexion = definirNiveauDeConnexion($_SESSION['state']);

// On récupère les informations pour l'ensemble des événements
$evenement = new Evenement();
$listEvenement = $evenement->getListEventParSport($idSport);

if (!empty($listEvenement)) {
    foreach ($listEvenement as $idEvent) {
        $infosEvent[$idEvent] = $evenement->getInfosEventVignette($idEvent);
    }
} else {
    $message = "Pas d'&eacute;v&eacute;nements r&eacute;pertori&eacute;s &agrave; cette date...";
}


// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------
$_SESSION['state']=$niveauConnexion.'_consultationListeEvenementParSport';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - Accueil";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneCentrale']=$views['consultationListeEvenements'];
$dataView['listeSports'] = $sport->getFiveTopSports();
if (isset($message)) { $dataView['message'] = utf8_encode($message); }

if ($niveauConnexion === "nonConnecte") {
    $dataView['zoneMenu']=$views['menuNonConnecte'];
} elseif ($niveauConnexion === "connecteParticipant") {
    $dataView['zoneMenu']=$views['menuConnecteParticipant'];
    $dataView['infosOrganisateur'] = $_SESSION['infosOrganisateur'];
} else {
    $dataView['zoneMenu']=$views['menuConnecteOrganisateur'];
    $dataView["infosParticipant"] = $_SESSION['infosParticipant'];
}
$dataView['css']=$css['stylePrincipal'];
$dataView['infosEvent'] = $infosEvent;



// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

