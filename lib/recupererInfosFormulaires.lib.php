<?php

/**
 * Récupérer les informations du formulaire
 * 
 * Fonctions qui permettent de récupérer les informations du formulaire
 * 
 * @author: Guillaume CARAYON
 * @version: 1.1.0
 * 
 * 1.1.0 : Modification au niveau de la répartition des infos (photos, desc, tel)
 *         + Accès avec filter_input 
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
        "confirmMail" => filter_input(INPUT_POST, 'confirmMail')
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
        "nomParticipant" => filter_input(INPUT_POST, "nomParticipant"),
        "prenomParticipant" => filter_input(INPUT_POST, "prenomParticipant"),
        "genreParticipant" => filter_input(INPUT_POST, "genreParticipant"),
        "dateNaissanceParticipant" => filter_input(INPUT_POST, "dateNaissanceParticipant"),
        "numTelPart" => filter_input(INPUT_POST, "numTelPart"),
        "uploadAvatarPart" => $_FILES["uploadAvatarPart"],
        "descPart" => filter_input(INPUT_POST, "descPart")
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
        "nomOrganisation" => filter_input(INPUT_POST, "nomOrganisation"),
        "typeOrganisation" => filter_input(INPUT_POST, "typeOrganisation"),
        "nomRef" => filter_input(INPUT_POST, "nomRef"),
        "prenomRef" => filter_input(INPUT_POST, "prenomRef"),
        "mailRef" => filter_input(INPUT_POST, "mailRef"),
        "numTelRef" => filter_input(INPUT_POST, "numTelRef"),
        "numTelOrg" => filter_input(INPUT_POST, "numTelOrg"),
        "descOrg" => filter_input(INPUT_POST, "descOrg"),
        "uploadAvatarOrg" => $_FILES["uploadAvatarOrg"]
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
        "numVoie" => filter_input(INPUT_POST,"numVoie"),
        "nomVoie" => filter_input(INPUT_POST,"nomVoie"),
        "cptVoie" => filter_input(INPUT_POST,"cptVoie"),
        "cpAdresse" => filter_input(INPUT_POST, "cpAdresse"),
        "villeAdresse" => filter_input(INPUT_POST, "villeAdresse"),
        "dptAdresse" => filter_input(INPUT_POST, "dptAdresse"),
        "regionAdresse" => filter_input(INPUT_POST,"regionAdresse"),
        "paysAdresse" => filter_input(INPUT_POST, "paysAdresse")
    );
}

/**
 * RecupererInfosConnexion
 * 
 * Permet de récupérer les informations pour la connexion à un compte
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosConnexion() {
    return array(
        "login" => filter_input(INPUT_POST, "login"),
        "password" => filter_input(INPUT_POST, "password")
    );
}

/**
 * Recuperer Infos Creation Evenement
 * 
 * Permet de récupérer les informations saisies lors de la création d'un événement
 * 
 * @return un tableau indicé avec les noms des champs des formulaires
 */
function recupererInfosCreationEvenement() {
    return array(
        "nomEvenement" => filter_input(INPUT_POST, "nomEvenement"),
        "sportsAssocies" => $_POST["sportsAssocies"],   // sinon mauvaise gestion du tableau
        "descEvenement" => filter_input(INPUT_POST, "descEvenement"),
        "uploadImageEvenement" => $_FILES['uploadImageEvenement'],
        "nbMinParticipants" => filter_input(INPUT_POST, "nbMinParticipants"),
        "nbMaxParticipants" => filter_input(INPUT_POST, "nbMaxParticipants"),
        "tarifEvenement" => filter_input(INPUT_POST, "tarifEvenement"),
        "debutEvent" => filter_input(INPUT_POST, "dateDebut")." ".filter_input(INPUT_POST, "heureDebut"),
        "finEvent" => filter_input(INPUT_POST, "dateFin")." ".filter_input(INPUT_POST, "heureFin")
    );
}

