<?php

/**
 * Retourner message erreur
 * 
 * Ensemble de fonctions qui permettent de déterminer le message d'erreur à retourner
 */

/**
 * Retourner message erreur selon la vérification globale
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @param int $verifGlob valeur retournée lors de la vérification globale
 * @return string $message message d'erreur à afficher
 */
function retournerMessageErreurVerifGlob($verifGlob) {
    switch ($verifGlob) {
        case EMPTY_TYPE_ACCOUNT : $message = "Veuillez s&eacute;lectionner un type de compte !";
            break;
        case EMPTY_LOGIN : $message = "Veuillez saisir un login !";
            break;
        case EMPTY_PASSWORD : $message = "Veuillez saisir un mot de passe !";
            break;
        case EMPTY_MAIL_ADDRESS : $message = "Veuillez d&eacute;finir une adresse mail !";
            break;
        case UNMATCH_PASSWORD : $message = "Le mot de passe n'est pas correct !";
            break;
        case UNMATCH_MAIL : $message = "L'adresse mail n'est pas valide !";
            break;
        default: $message = "Formulaire non valide";
            break;
    }

    return $message;
}

/**
 * Retourner message erreur selon la vérification des infos de l'organisation
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @param int $verifOrg valeur retournée lors de la vérification des infos de l'organisation
 * @return string $message message d'erreur à afficher
 */
function retournerMessageErreurVerifOrg($verifOrg) {
    switch ($verifOrg) {
        case EMPTY_NOM : $message = "Veuillez saisir un nom pour votre organisation !";
            break;
        case EMPTY_TYPE_ORG : $message = "Veuillez s&eacute;lectionner un type d'organisation !";
            break;
        case EMPTY_TEL : $message = "Veuillez saisir le num&eacute;ro de t&eacute;l&eacute;phone de votre organisation";
            break;
        case EMPTY_NOM_REF : $message = "Veuillez saisir le nom de votre r&eacute;f&eacute;rent !";
            break;
        case EMPTY_PRENOM_REF : $message = "Veuillez saisir le pr&eacute;nom de votre r&eacute;f&eacute;rent !";
            break;
        case EMPTY_MAIL_REF : $message = "Veuillez saisir l'adresse e-mail du r&eacute;f&eacute;rent !";
            break;
        case EMPTY_TEL_REF : $message = "Veuillez saisir le t&eacute;l&eacute;phone du r&eacute;f&eacute;rent !";
            break;
        default: $message = "Formulaire non valide";
            break;
    }

    return $message;
}

/**
 * Retourner message erreur selon la vérification des infos de la localisation
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @param int $verifLoc valeur retournée lors de la vérification des infos de la localisation
 * @return string $message message d'erreur à afficher
 */
function retournerMessageErreurVerifLoc($verifLoc) {
    switch ($verifLoc) {
        case EMPTY_ADRESSE : $message = "Veuillez saisir l'adresse de votre organisation!";
            break;
        case EMPTY_CODE_POSTAL : $message = "Veuillez saisir le code postal de votre organisation";
            break;
        case EMPTY_VILLE : $message = "Veuillez saisir la ville de votre organisation";
            break;
        default: $message = "Formulaire non valide";
    }

    return $message;
}


function retournerMessageErreurVerifUpload($resUpload) {
    switch ($resUpload) {
        case FAIL_UPLOAD : $message = "L'upload a échoué !"; break;
        case UNMATCH_MIME_TYPE : $message = "Le type n'est pas valide !"; break;
        case BAD_TYPE : $message = "Le type n'est pas valide !"; break;
        case HEAVY_FILE : $message = "Le fichie est trop lourd !"; break;
        case ERROR_FILE : $message = "Erreur lors de l'upload"; break;
        case EMPTY_FILE : $message = "Le fichier est vide !"; break;
        default: $message = "Upload non valide";
    }
    
    return $message;
}
