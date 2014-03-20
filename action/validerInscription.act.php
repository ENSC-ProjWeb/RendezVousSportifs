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
 * @todo faire un contrôle pour l'upload des photos
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

$infosGlobales = recupererInfosGlobales();      // tableau contenant les infos de connexions
//var_dump($infosGlobales);
$typeCompte = $infosGlobales["typeCompte"];     // type de compte a inscrire

// $typeCompte >> On récupère les infos correspondantes au type d'inscrition >> $infosParticipant, $participant OU $infosOrganisateur, $organisateur
if ($typeCompte === "participant") {
    $infosParticipant = recupererInfosParticipant();    // tableau d'infos concernant le participant
    $participant = new Participant();                   // modèle pour les participants
} else {
    $infosOrganisateur = recupererInfosOrganisateur();  // tableau d'infos concernant l'organisateur
    //var_dump($infosOrganisateur);
    $organisateur = new Organisateur();                 // modèle pour l'organisateur
}

$image = new Image();                                  // modèle pour les avatars
$infosLocalisation = recupererInfosLocalisation();      // tableau contenant les infos de localisation

/* ---------------------------------------------------------
 * Executer l'action
  /* --------------------------------------------------------- */

// $infosGlobales, $typeCompte >> Vérification des informations >> $verifGlob, [$verifOrg], [$verifLoc]
$verifGlob = verifierFormulaireGlobal($infosGlobales);
if ($typeCompte === "organisateur") {
    $verifOrg = verifierFormulaireOrganisateur($infosOrganisateur);
    $verifLoc = verifierFormulaireLocalisation($infosLocalisation);
}

//var_dump($verifGlob);
//var_dump($verifOrg);
//var_dump($verifLoc);

// $verifGlob, [$verifOrg], [$verifLoc] >> On indique si l'enregistrement est globalement valide ou pas >> $inscriptionValide
if ($verifGlob === VALIDE) {
    //var_dump($verifGlob);
    if (isset($verifOrg)) {
        if ($verifOrg === VALIDE) {
            if (isset($verifLoc)) {
                $inscriptionValide = true;
            } else {
                $inscriptionValide = false;
            }
        } else {
            $inscriptionValide = false;
        }
    } else {
        $inscriptionValide = true;
    }
} else {
    $inscriptionValide = false;
}

//var_dump($inscriptionValide);

// $inscriptionValide >> Si les informations ne sont pas valides on renvoit un message d'erreur >> $message
if (!$inscriptionValide) {
    if ($verifGlob !== VALIDE) {
        $message = utf8_encode(retournerMessageErreurVerifGlob($verifGlob));
    } elseif ($typeCompte == "organisateur") {
        if ($verifOrg !== VALIDE) {
            $message = utf8_encode(retournerMessageErreurVerifOrg($verifOrg));
        } elseif ($verifLoc !== VALIDE) {
            $message = utf8_encode(retournerMessageErreurVerifLoc($verifLoc));
        }
    }
} else {
    // $infosGlobales['password'] >> Hashage du mot de passe >> $infosGlobales["password"]
    $infosGlobales["password"] = hashPassword($infosGlobales["password"]);

    // $infosGlobales >> Gestion de l'upload de l'image >> $resUploadPhoto
    if ($typeCompte === "participant") {
        $resUploadPhoto = uploadPhotos($infosParticipant["uploadAvatarPart"], "./img/avatar");
    } else {
        $resUploadPhoto = uploadPhotos($infosOrganisateur["uploadAvatarOrg"], "./img/avatar");
    }

    // $typeCompte, $participant, $organisateur, $infosGlobale, $infosOrganisateur, $infosLocalisation >> Insertion dans la base de données >> $res
    if ($typeCompte === "participant") {
        $res = $participant->insertParticipant($infosGlobales, $infosParticipant, $infosLocalisation);
    } else {
        $res = $organisateur->insertOrganisateur($infosGlobales, $infosOrganisateur, $infosLocalisation);
    }
    
    //var_dump($res);

    $ajoutImage = $image->insertImageUtilisateur($infosGlobales['login'], $resUploadPhoto["nomPhoto"], $resUploadPhoto["empPhoto"]);

    // $res >> Message de validation ou non >> $message
    if ($res) {
        $message = utf8_encode("Votre compte a bien &eacute;t&eacute; ajout&eacute; !");
    } else {
        $message = utf8_encode("Votre compte n'a pas pu &ecirc;tre ajout&eacute; !");
    }
}


/* -------------------------------------------------------
 *  Definir le nouvel etat de l'application
 * ------------------------------------------------------- */

if ($inscriptionValide && $res) {
    $_SESSION['state'] = 'nonConnecte_accueil';
} else {
    $_SESSION['state'] = 'nonConnecte_enregistrement';
}
/* -------------------------------------------------------
 * Preparer les donnees de la vue resultante
 * ------------------------------------------------------- */

// Definition des donnees structurelles de la vue dans tous les cas
$dataView['zoneHaute'] = $views['banniere'];
$dataView['zoneRecherche'] = $views['recherche'];
$dataView['zoneMenu'] = $views['menuNonConnecte'];
$dataView['message'] = $message;
$dataView['css'] = $css['stylePrincipal'];

if ($_SESSION['state'] === "nonConnecte_accueil") {
    $dataView['title'] = TITLE . " - Enregistrement valide !";
    $dataView['zoneCentrale'] = $views['accueil'];
} else {
    $dataView['title'] = TITLE . " - Enregistrement refusé !";
    $dataView['zoneCentrale'] = $views['enregistrement'];
}

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView'] = $dataView;



