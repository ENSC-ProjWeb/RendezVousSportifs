<?php

/**
 * Inscrire événement
 * 
 * Action qui permet à un membre de s'inscrire à un événement (etat nonConnecte_accueil)
 * 
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Modele"];
include $models["Adresse"];
include $models["Participant"];
include $models["Evenement"];

$login = $_SESSION["login"]; 
$idEvent = filter_input(INPUT_GET, "idEvent");

$participant = new Participant();
// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// On récupère les informations concernant l'événement
$evenement = new Evenement();
$infosEvenement = $evenement->getInfosEvent($idEvent);

// Je modifie son statut d'inscription
if ($evenement->preInscrireMembre($idEvent, $login) === true) {
 
    $message = "Votre inscription va &ecirc;tre trait&eacute;e par l'organisateur";
} else {
    $message = "Votre inscription n'a pas pu &ecirc;tre prise en compte...";
}

$statut = $participant->getStatutInscriptionEvent($idEvent, $login);

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state'] = 'connecteParticipant_consultationEvenement';

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['message'] = $message;
$dataView['title']=TITLE.' - '.$infosEvenement['infosEvent']['nomEvent'];
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['css']=$css['stylePrincipal'];
$dataView['zoneMenu'] = $views['menuConnecteParticipant'];
$dataView['infosParticipant'] = $_SESSION['infosParticipant'];
$dataView['zoneCentrale'] = $views['consultationEvenementConnecte'];
$dataView['nomEvent'] = $infosEvenement['infosEvent']['nomEvent'];
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


