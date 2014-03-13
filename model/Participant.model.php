<?php

/**
 * Modèle Organisateur
 *
 * @author Guillaume
 * @version 1.0.0
 */

class Participant extends Modele {

    /**
     * Insertion de participant
     * 
     * Insère les infos nécessaires au participant dans la base de données
     * @param string $login login de l'utilisateur 
     * @param array $infosParticipant tableau contenant les infos du participant
     * @param array $infosLoc tableau contenant les infos de localisation
     */
    public function insertParticipant($infosGlob, $infosParticipant, $infosLoc) {
        
        // Instanciation des modèles nécessaires
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();

        // Insertion des données progressives
        $utilisateur->insertUtilisateur($infosGlob);
        $insertAdresse = $adresse->insertAdresse($infosLoc);
        $reqParticipant = "INSERT INTO PARTICIPANT VALUES ('',:nomParticipant, :prenomParticipant, :genreParticipant, :dateNaissanceParticipant, :loginUser, :idAdresse)";
        $paramsParticipant = array(
            "nomParticipant" => $infosParticipant["nomParticipant"],
            "prenomParticipant" => $infosParticipant["prenomParticipant"],
            "genreParticipant" => $infosParticipant["genreParticipant"],
            "dateNaissanceParticipant" => $infosParticipant["dateNaissanceParticipant"],
            "loginUser" => $infosGlob["login"],
            "idAdresse" => $insertAdresse['idAdresse']);
        $insertParticipant = $this->executerRequete($reqParticipant, $paramsParticipant);
        return $insertParticipant;
    }
 } 
