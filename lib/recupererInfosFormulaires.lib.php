<?php

/**
 * Récupérer les informations du formulaire
 * 
 * Fonctions qui permettent de récupérer les informations du formulaire
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 */

/**
 * RecupererInfosGlobales
 * 
 * Permet de récupérer les informations globales d'un formulaire d'enregistrement
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosGlobales() {
    return array(
        "typeCompte" => filter_input(INPUT_POST, 'typeCompte'),
        "login" => filter_input(INPUT_POST, 'login'),
        "password" => filter_input(INPUT_POST, 'password'),
        "confirmPassword" => filter_input(INPUT_POST, 'confirmPassword'),
        "adresseMail" => filter_input(INPUT_POST, 'adresseMail'),
        "confirmMail" => filter_input(INPUT_POST, 'confirmMail'),
        "numTel" => filter_input(INPUT_POST, 'numTel'),
        "desc" => filter_input(INPUT_POST, 'desc'),
        "uploadAvatar" => $_FILES["uploadAvatar"]
    );
}

/**
 * RecupererInfosParticipant
 * 
 * Permet de récupérer les informations d'un participant dans un formulaire d'enregistrement
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosParticipant() {
    return array(
        "nomParticipant" => $_POST["nomParticipant"],
        "prenomParticipant" => $_POST["prenomParticipant"],
        "genre" => $_POST["genre"],
        "dateNaissance" => $_POST["dateNaissance"]
    );
}

/**
 * RecupererInfosOrganisateur
 * 
 * Permet de récupérer les informations d'un organisateur
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosOrganisateur() {
    return array(
        "nomOrganisation" => $_POST["nomOrganisation"],
        "typeOrganisation" => $_POST["typeOrganisation"],
        "nomRef" => $_POST["nomRef"],
        "prenomRef" => $_POST["prenomRef"],
        "mailRef" => $_POST["mailRef"],
        "numTelRef" => $_POST["numTelRef"],
    );
}

/**
 * RecupererInfosLocalisation
 * 
 * Permet de récupérer les informations concernant la localisation
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosLocalisation() {
    return array(
        "numVoie" => $_POST["numVoie"],
        "nomVoie" => $_POST["nomVoie"],
        "cptVoie" => $_POST["cptVoie"],
        "cpAdresse" => $_POST["cpAdresse"],
        "villeAdresse" => $_POST["villeAdresse"],
        "dptAdresse" => $_POST["dptAdresse"],
        "regionAdresse" => $_POST["regionAdresse"],
        "paysAdresse" => $_POST["paysAdresse"]
    );
}
