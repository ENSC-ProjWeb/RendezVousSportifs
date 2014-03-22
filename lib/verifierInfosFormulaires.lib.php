<?php

/**
 * Vérifier Infos Formulaires
 * 
 * Permet de vérifier côté serveur les informations saisies par l'utilisateur dans les formulaires
 * 
 */
// Constantes de retour
define("VALIDE", 1);

/**
 * Verifier Formulaire Global
 * 
 * Permet de vérifier côté serveur les infos de connexion saisie par l'utilisateur
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0.
 * 
 * @params: array $infosGlobales informations relatives à l'identification
 * @return: EMPTY_LOGIN si le login est vide
 * @return: EMPTY_PASSWORD si le mot de passe est vide
 * @return: EMPTY_MAIL_ADDRESS si l'adresse mail est vide
 * @return: UNMATCH_PASSWORD si le mot de passe n'est pas valide
 * @return: UNMATCH_MAIL si l'adresse mail n'est pas valide
 * @return: EMPTY_TEL si le téléphone n'est pas précisé pour un compte organisateur
 * @return: TRUE si cette partie est correcte
 */
function verifierFormulaireGlobal($infosGlobales) {

    define("EMPTY_LOGIN", -1);
    define("EMPTY_PASSWORD", -2);
    define("EMPTY_MAIL_ADDRESS", -3);
    define("EMPTY_TYPE_ACCOUNT", -4);
    define("UNMATCH_PASSWORD", -5);
    define("UNMATCH_MAIL", -6);

    $typeCompte = $infosGlobales["typeCompte"];
    $login = $infosGlobales["login"];
    $password = $infosGlobales["password"];
    $confirmPassword = $infosGlobales["confirmPassword"];
    $adresseMail = $infosGlobales["adresseMail"];
    $confirmMail = $infosGlobales["confirmMail"];

    if (empty($typeCompte)) {
        return EMPTY_TYPE_ACCOUNT;
    } elseif (empty($login)) {
        return EMPTY_LOGIN;
    } elseif (empty($password)) {
        return EMPTY_PASSWORD;
    } elseif (empty($adresseMail)) {
        return EMPTY_MAIL_ADDRESS;
    } elseif ($password !== $confirmPassword) {
        return UNMATCH_PASSWORD;
    } elseif ($adresseMail !== $confirmMail) {
        return UNMATCH_MAIL;
    } else {
        return VALIDE;
    }
}

/**
 * Verifier Formulaire Organisateur
 * 
 * Permet de vérifier les informations saisies par les organisateurs
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @params: array $infosOrganisateur tableau contenant les infos des organisateurs
 * @return: EMPTY_NOM si le nom de l'organisation est vide
 * @return: EMPTY_TYPE_ORG si le type de l'organisation n'est pas précisé
 * @return: EMPTY_NOM_REF si le nom du référent est vide
 * @return: EMPTY_PRENOM_REF si le prénom du référent est vide
 * @return: EMPTY_TEL_REF si le téléphone du référent est vide
 * @return: EMPTY_MAIL_REF si le mail du référent est vide
 * @return: VALIDE si le formulaire est correct
 */
function verifierFormulaireOrganisateur($infosOrg) {
    define("EMPTY_TYPE_ORG", -1);
    define("EMPTY_NOM", -2);
    define("EMPTY_NOM_REF", -3);
    define("EMPTY_PRENOM_REF", -4);
    define("EMPTY_MAIL_REF", -5);
    define("EMPTY_TEL_REF", -6);
    define("EMPTY_TEL", -7);

    $nomOrganisation = $infosOrg["nomOrganisation"];
    $typeOrganisation = $infosOrg["typeOrganisation"];
    $nomRef = $infosOrg["nomRef"];
    $prenomRef = $infosOrg["prenomRef"];
    $numTelRef = $infosOrg["numTelRef"];
    $mailRef = $infosOrg["mailRef"];
    $numTelOrg = $infosOrg["numTelOrg"];

    if (empty($nomOrganisation)) {
        return EMPTY_NOM;
    } elseif (empty($typeOrganisation)) {
        return EMPTY_TYPE_ORG;
    } elseif (empty($numTelOrg)) {
        return EMPTY_TEL;
    } elseif (empty($nomRef)) {
        return EMPTY_NOM_REF;
    } elseif (empty($prenomRef)) {
        return EMPTY_PRENOM_REF;
    } elseif (empty($numTelRef)) {
        return EMPTY_TEL_REF;
    } elseif (empty($mailRef)) {
        return EMPTY_MAIL_REF;
    } else {
        return VALIDE;
    }
}

/**
 * Vérifier formulaire localisation
 * 
 * Permet de vérifier le formulaire de localisation
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @params: array $infosLoc tableau contenant les informations de localisation
 * @return: EMPTY_ADRESSE si l'adresse est vide
 * @return: EMPTY_CODE_POSTAL si le code postal est vide
 * @return: EMPTY_VILLE si la ville est vide
 * 
 */
function verifierFormulaireLocalisation($infosLoc) {
    define('EMPTY_ADRESSE', -1);
    define('EMPTY_CODE_POSTAL', -2);
    define('EMPTY_VILLE', -3);

    $adresse = $infosLoc["nomVoie"];
    $codePostal = $infosLoc["cpAdresse"];
    $ville = $infosLoc["villeAdresse"];

    if (empty($adresse)) {
        return EMPTY_ADRESSE;
    } elseif (empty($codePostal)) {
        return EMPTY_CODE_POSTAL;
    } elseif (empty($ville)) {
        return EMPTY_VILLE;
    } else {
        return VALIDE;
    }
}


function verifierFormulaireCreationEvenement($infosEvenement) {
    define("EMPTY_NAME", -1);
    define('EMPTY_DATE_DEBUT', -2);
    define("EMPTY_SPORT", -3);
    
    $nomEvenement = $infosEvenement["nomEvenement"];
    $debutEvent = $infosEvenement["debutEvent"];
    $sportsAssocies = $infosEvenement["sportsAssocies"];
    
    if (empty($nomEvenement)) {
        return EMPTY_NAME;
    } elseif (empty($debutEvent)) {
        return EMPTY_DATE_DEBUT;
    } elseif (empty($sportsAssocies)) {
        return EMPTY_SPORT;
    } else {
        return VALIDE;
    }
}
