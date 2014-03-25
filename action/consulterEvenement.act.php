<?php

/**
 * Consulter événement
 * 
 * Action qui permet de consulter la page d'un événement (etat nonConnecte_accueil)
 * 
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Modele"];
include $models["Adresse"];
include $models["Participant"];
include $models["Evenement"];

if (isset($_SESSION['login'])) { $login = $_SESSION["login"]; }
$idEvent = filter_input(INPUT_GET, "idEvent");

$participant = new Participant();
// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// On récupère les informations concernant l'événement
$evenement = new Evenement();
$infosEvenement = $evenement->getInfosEvent($idEvent);

// Je définis mon niveau de connexion
$monEtat = definirNiveauDeConnexion($_SESSION['state']);

if ($niveauConnexion == "connecteParticipant") {
    // On regarde s'il est déjà inscrit à un événement
    $statut = $participant->getStatutInscriptionEvent($idEvent, $login);
}

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state'] = $niveauConnexion.'_consultationEvenement';

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE.' - '.$infosEvenement['infosEvent']['nomEvent'];
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['css']=$css['stylePrincipal'];

if ($niveauConnexion === 'nonConnecte') {
    $dataView['zoneMenu'] = $views['menuNonConnecte'];
    $dataView['zoneCentrale'] = $views['consultationEvenementGlobal'];
} elseif ($niveauConnexion === 'connecteParticipant') {
    $dataView['zoneMenu'] = $views['menuConnecteParticipant'];
    $dataView['infosParticipant'] = $_SESSION['infosParticipant'];
    $dataView['zoneCentrale'] = $views['consultationEvenementConnecte'];
} else {
    $dataView["zoneMenu"] = $views['menuConnecteOrganisateur'];
    $dataView["infosOrganisateur"] = $_SESSION["infosOrganisateur"];
    $dataView["zoneCentrale"] = $views["consultationEvenementConnecte"];
}

$dataView['nomEvent'] = $infosEvenement['infosEvent']['nomEvent'];
$dataView['descEvent'] = $infosEvenement['infosEvent']['descriptionEvent'];
$dataView['nomOrganisateur'] = $infosEvenement['infosOrganisateur']['nomOrganisateur'];
$dataView['sportsAssocies'] = $infosEvenement['sportsAssocies'];
$dataView['empImagePrincipale'] = $infosEvenement['imagesEvent'][0]['cibleImage'];
$dataView['nomImagePrincipale'] = $infosEvenement['imagesEvent'][0]['nomImage'];
$dataView['debutEvent'] = $infosEvenement['infosEvent']['debutEvent'];
$dataView['finEvent'] = $infosEvenement['infosEvent']['finEvent'];
$dataView['tarifEvent'] = $infosEvenement['infosEvent']['prixEvent'];
$dataView['nbMinParticipants'] = $infosEvenement['infosEvent']['nbParticipantsMin'];
$dataView['nbMaxParticipants'] = $infosEvenement['infosEvent']['nbParticipantsMax'];
$dataView['adresse'] = (($infosEvenement['localisation']['numVoieAdresse'] == '0') ? ' ' : $infosEvenement['localisation']['numVoieAdresse']).' '.$infosEvenement['localisation']['nomVoieAdresse'].'<br/>'.$infosEvenement['localisation']['cptVoieAdresse'].'<br/>'.$infosEvenement['localisation']['codePostalAdresse'].' '.$infosEvenement['localisation']['villeAdresse'].'<br/>'.$infosEvenement['localisation']['dptAdresse'].' '.$infosEvenement['localisation']['regionAdresse'].'<br/>'.$infosEvenement['localisation']['paysAdresse'];
// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  


