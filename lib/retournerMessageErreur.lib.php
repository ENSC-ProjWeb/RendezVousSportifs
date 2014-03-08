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
        case EMPTY_TYPE_ACCOUNT : $message = "Veuillez sélectionner un type de compte !";
            break;
        case EMPTY_LOGIN : $message = "Veuillez saisir un login !";
            break;
        case EMPTY_PASSWORD : $message = "Veuillez saisir un mot de passe !";
            break;
        case EMPTY_MAIL_ADDRESS : $message = "Veuillez définir une adresse mail !";
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
        case EMPTY_TYPE_ORG : $message = "Veuillez sélectionner un type d'organisation !";
            break;
        case EMPTY_TEL : $message = "Veuillez saisir le numéro de téléphone de votre organisation";
            break;
        case EMPTY_NOM_REF : $message = "Veuillez saisir le nom de votre référent !";
            break;
        case EMPTY_PRENOM_REF : $message = "Veuillez saisir le prénom de votre référent !";
            break;
        case EMPTY_MAIL_REF : $message = "Veuillez saisir l'adresse e-mail du référent !";
            break;
        case EMPTY_TEL_REF : $message = "Veuillez saisir le téléphone du référent !";
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
