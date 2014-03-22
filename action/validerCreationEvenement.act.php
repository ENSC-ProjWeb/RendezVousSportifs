<?php

/**
 * Valider inscription
 * 
 * Action qui permet de valider l'inscription pour le membre
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @todo faire une vérification par rapport au login déjà existant
 * @todo faire en sorte que l'image pour l'avatar soit sauvegardée
 */
/* -------------------------------------------------------
 * Recuperer les donnees d'entree nécessaires à l'action
 * ------------------------------------------------------- */

// Modèles utilisés pour les données
include $models['Modele'];
include $models['Adresse'];
include $models['Utilisateur'];
include $models['Organisateur'];
include $models['Participant'];
include $models['Image'];
include $models['Evenement'];

$infosEvenement = recupererInfosCreationEvenement();  
var_dump($infosEvenement);
$login = $_SESSION["login"];
$organisateur = new Organisateur();
$infosOrganisateur = $organisateur->getOrganisateur($login);
$idOrganisateur = $infosOrganisateur["idOrganisateur"];
$creationEvenement = false;

$image = new Image();                                   // modèle pour les avatars
$infosLocalisation = recupererInfosLocalisation();      // tableau contenant les infos de localisation

/* ---------------------------------------------------------
 * Executer l'action
 * --------------------------------------------------------- */

// On vérifie les données de l'événement
$verifInfosEvenement = verifierFormulaireCreationEvenement($infosEvenement);
if ($verifInfosEvenement === VALIDE) {
    $verifInfosLocalisation = verifierFormulaireLocalisation($infosLocalisation);
    
    if ($verifInfosLocalisation === VALIDE) {
        // On insère les informations de l'événement dans la BDD
        $evenement = new Evenement();
        $evenement->insertEvenement($infosEvenement, $infosLocalisation, $idOrganisateur);
    
        // On upload la photo sur le serveur
        $resUploadPhoto = uploadPhotos($infosEvenement["uploadImageEvenement"], "./img");
        if (is_array($resUploadPhoto)) {
            $lastIdEvent = $evenement->getLastIdEvent();
            $image->insertImageEvenement($lastIdEvent, $resUploadPhoto["nomPhoto"], $resUploadPhoto["empPhoto"]);
            $message = "Votre &eacute;v&eacute;nement a bien &eacute;t&eacute; cr&eacute;&eacute;";
            $creationValide = true;
        }   elseif ($resUploadPhoto == ERROR_FILE) {
            $message = "Votre &eacute;v&eacute;nement a bien &eacute;t&eacute; cr&eacute;&eacute;";
            $creationValide = true;
        } else {
            $message = retournerMessageErreurVerifUpload($resUploadPhoto);
        }
    } else {
        $message = retournerMessageErreurVerifLoc($verifInfosLocalisation);
    }
} else {
    $message = retournerMessageErreurVerifEvenement($verifInfosEvenement);
}


/* -------------------------------------------------------
 *  Definir le nouvel etat de l'application
 * ------------------------------------------------------- */

if (!$creationValide) {
    $_SESSION['state'] = "connecteOrganisateur_creationEvenement";
} else {
    $_SESSION['state'] = 'connecteOrganisateur_accueil';
}
/* -------------------------------------------------------
 * Preparer les donnees de la vue resultante
 * ------------------------------------------------------- */

// Definition des donnees structurelles de la vue dans tous les cas
$dataView['zoneHaute'] = $views['banniere'];
$dataView['zoneRecherche'] = $views['recherche'];
$dataView['zoneMenu'] = $views['menuConnecteOrganisateur'];
$dataView['message'] = utf8_encode($message);
$dataView['css'] = $css['stylePrincipal'];
$dataView['infosOrganisateur'] = $_SESSION["infosOrganisateur"];

if ($_SESSION['state'] === "connecteOrganisateur_accueil") {
    $dataView['title'] = TITLE . " - Création valide !";
    $dataView['zoneCentrale'] = $views['accueil'];
} else {
    $dataView['title'] = TITLE . " - Création refusé !";
    $dataView['zoneCentrale'] = $views['creationEvenement'];
}

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView'] = $dataView;



