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
     * 
     * @return l'id du participant inséré
     */
    public function insertParticipant($infosGlob, $infosParticipant, $infosLoc) {

        // Instanciation des modèles nécessaires
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();
        
        // Insertion des données progressives
        $utilisateur->insertUtilisateur($infosGlob);
        $idAdresse = $adresse->insertAdresse($infosLoc);
        $reqParticipant = "INSERT INTO PARTICIPANT VALUES ('',:nomParticipant, :prenomParticipant, :genreParticipant, STR_TO_DATE(:dateNaissanceParticipant, '%d/%m/%Y'), :loginUser, :idAdresse)";
        $paramsParticipant = array(
            "nomParticipant" => $infosParticipant["nomParticipant"],
            "prenomParticipant" => $infosParticipant["prenomParticipant"],
            "genreParticipant" => $infosParticipant["genreParticipant"],
            "dateNaissanceParticipant" => $infosParticipant["dateNaissanceParticipant"],
            "loginUser" => $infosGlob["login"],
            "idAdresse" => $idAdresse);
        $this->executerRequete($reqParticipant, $paramsParticipant);
        $updUser = "UPDATE UTILISATEUR SET telUser = :telUser, descUser = :descUser WHERE loginUser = :loginUser";
        return $this->executerRequete($updUser, array("telUser" => $infosParticipant["numTelPart"], "descUser" => $infosParticipant["descPart"], "loginUser" => $infosGlob["login"]));
    }

    /**
     * Get Participant
     * 
     * Permet de récupérer les infos d'un participant à partir d'un login
     * 
     * @param string $login login saisi par l'utilisateur
     * @return array avec les informations sur le participant
     */
    public function getParticipant($login) {
        $req = "SELECT * FROM PARTICIPANT WHERE loginUser = :login";
        $infos = $this->executerRequete($req, array("login" => $login));
        return $infos->fetch();
    }

    /**
     *  Get Nb Evenement A Venir
     * 
     * Permet de récupérer le nombre à venir d'événements pour un participant
     * @param string $login login de l'utilisateur
     * @return int nombre d'événements à venir
     */
    public function getNbEvenementAVenir($login) {
        $req = "SELECT COUNT( idEvent ) AS NBEVENTTOCOME FROM INSCRIRE, PARTICIPANT WHERE INSCRIRE.idParticipant = PARTICIPANT.idParticipant AND PARTICIPANT.loginUser =  :login AND INSCRIRE.statutInscription =  'I'";
        $infos = $this->executerRequete($req, array("login" => $login));
        $res = $infos->fetch();
        return $res["NBEVENTTOCOME"];
    }

    /**
     * Get Nb Evenement en Attente
     * 
     * Permet de récupérer le nombre d'événement en attente pour un participant
     * @param string $login login de l'utilisateur
     * @return int nombre d'événements en attente
     */
    public function getNbEvenementEnAttente($login) {
        $req = "SELECT COUNT( idEvent ) AS NBEVENTTOCOME FROM INSCRIRE, PARTICIPANT WHERE INSCRIRE.idParticipant = PARTICIPANT.idParticipant AND PARTICIPANT.loginUser =  :login AND INSCRIRE.statutInscription =  'PI'";
        $infos = $this->executerRequete($req, array("login" => $login));
        $res = $infos->fetch();
        return $res["NBEVENTTOCOME"];
    }
    
    
    public function getStatutInscriptionEvent($idEvent, $login) {
        $resIdParticipant = $this->getParticipant($login);
        $idParticipant = $resIdParticipant["idParticipant"];
  
        $reqStatut = "SELECT statutInscription FROM INSCRIRE WHERE idEvent = :idEvent AND idParticipant = :idParticipant";
        $resStatut = $this->executerRequete($reqStatut, array("idEvent" => $idEvent, "idParticipant" => $idParticipant));
        $infosStatut = $resStatut->fetch();
        $statut = $infosStatut["statutInscription"];
        
        return $statut;
    }
 } 
