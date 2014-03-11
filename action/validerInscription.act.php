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
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

$infosGlobales = recupererInfosGlobales();
$typeCompte = $infosGlobales["typeCompte"];

if ($typeCompte === "participant")
{
    $infosParticipant = recupererInfosParticipant();
    $participant = new Participant();
}else{
    $infosOrganisateur = recupererInfosOrganisateur();
    $organisateur = new Organisateur();
}

$infosLocalisation = recupererInfosLocalisation();

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// Vérification des informations
$verifGlob = verifierFormulaireGlobal($infosGlobales);
if ($typeCompte === "organisateur") {
    $verifOrg = verifierFormulaireOrganisateur($infosOrganisateur);
    $verifLoc = verifierFormulaireLocalisation($infosLocalisation);
}

// On indique si l'enregistrement est globalement valide ou pas
if ($verifGlob === VALIDE) {
    if (isset($verifOrg) && $verifOrg === VALIDE)
    {
        if (isset($verifLoc) && $verifLoc === VALIDE) {
            $inscriptionValide = true;
        }
    }
} else {
    $inscriptionValide = false;
}

// Si les informations ne sont pas valides on renvoit un message d'erreur
if (!$inscriptionValide) {
    if ($verifGlob !== VALIDE)
    {
        $message = utf8_encode(retournerMessageErreurVerifGlob($verifGlob));
    }elseif($typeCompte == "organisateur") {
        if ($verifOrg !== VALIDE){
            $message = utf8_encode(retournerMessageErreurVerifOrg($verifOrg));
        }elseif($verifLoc !== VALIDE) {
            $message = utf8_encode(retournerMessageErreurVerifLoc($verifLoc));
        }
    }
}else{
    // Hashage du mot de passe
    $infosGlobales["password"] = hashPassword($infosGlobales["password"]);
    // Gestion de l'upload de l'image avec redimensionnement
    $resUploadPhoto = uploadPhotos($infosGlobales["uploadAvatar"], "./img/avatar");
    // Insertion dans la base de données
    if ($typeCompte === "participant")
    {
        $res = $participant->insertParticipant($infosGlobales, $infosParticipant, $infosLocalisation);
    } else {
        $res = $organisateur->insertOrganisateur($infosGlobales, $infosOrganisateur, $infosLocalisation);
    }
    // Message de validation ou non
    if ($res) {
        $message = utf8_encode("Votre compte a bien été ajouté !");
    } else {
        $message = utf8_encode("Votre compte n'a pas pû être ajouté !");
    }
  
}


// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

if ($inscriptionValide && $res) {
    $_SESSION['state'] = 'nonConnecte_accueil';
} else {
    $_SESSION['state'] = 'nonConnecte_enregistrement';
}
// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue dans tous les cas
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuNonConnecte'];
$dataView['message'] = $message;
$dataView['css']=$css['stylePrincipal'];

if ($_SESSION['state'] === "nonConnecte_accueil") {
    $dataView['title'] = TITLE." - Enregistrement valide !";
    $dataView['zoneCentrale'] = $views['accueil'];
} else {
    $dataView['title'] = TITLE." - Enregistrement refusé !";
    $dataView['zoneCentrale'] = $views['enregistrement'];
}

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  


