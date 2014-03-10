<?php

/**
 * Modèle Organisateur
 *
 * @author Guillaume
 * @version 1.0.0
 */

include $models["Modele"];
include $models["Utilisateur"];
include $models["Adresse"];

class Participant extends Modele {
    
    /**
     * Insertion de participant
     * 
     * Insère les infos nécessaires au participant dans la base de données
     * @param string $login login de l'utilisateur 
     * @param array $infosParticipant tableau contenant les infos du participant
     * @param array $infosLoc tableau contenant les infos de localisation
     */
    
    public function insertParticipant($infosGlob, $infosParticipant, $infosLoc)
    {
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();
        
        $utilisateur->insertUtilisateur($infosGlob);
        $adresse->insertAdresse($infosLoc);
        
        $reqParticipant = "INSERT INTO PARTICIPANT VALUES (:nomParticipant, :prenomParticipant, :genreParticipant, :dateNaissanceParticipant, :loginUser, :idAdresse)";
        $bdd = $this->getBdd();
        $insertParticipant = $bdd->prepare($reqParticipant);
        $insertParticipant->execute(array(
            "nomParticipant" => $infosParticipant["nomParticipant"],
            "prenomParticipant" => $infosParticipant["prenomParticipant"],
            "genreParticipant" => $infosParticipant["genreParticipant"],
            "dateNaissanceParticipant" => $infosParticipant["dateNaissanceParticipant"],
            "loginUser" => $infosGlob["login"],
            "idAdresse" => "(SELECT LAST_INSERT_ID() FROM ADRESSE)"
        ));
    }
}
