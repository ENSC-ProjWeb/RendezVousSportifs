<?php

class Evenement extends Modele
{
    /**
     * InsertEvenement
     * 
     * Permet d'insérer un événement dans la base de données
     * 
     * @param array $infosEvenement contient les informations de l'événement
     * @param array $infosLoc contient les informations de localisation
     * @param int $idOrganisateur contient l'id de l'organisateur
     * @return un objet PDO
     * 
     * @todo Factoriser le code...
     */
    public function insertEvenement($infosEvenement, $infosLoc, $idOrganisateur)
    {
        // On insère l'adresse de l'événement
        $adresse = new Adresse();
        $adresse->insertAdresse($infosLoc);
        $lastIdAdresse = $this->getLastId("idAdresse", "ADRESSE");
        $debutEvent = $infosEvenement['debutEvent'];
        $finEvent = $infosEvenement['finEvent'];
        // On insère ensuite les informations concernant les événements
        $evenement = "INSERT INTO EVENEMENT VALUES ('', :nomEvent, :nbParticipantsMax, :nbParticipantsMin, :prixEvent, :description, :debutEvent, :finEvent, :idAdresse)";
        $paramsEvenement = array(
            "nomEvent" => $infosEvenement['nomEvenement'],
            "nbParticipantsMax" =>  $infosEvenement['nbMaxParticipants'],
            "nbParticipantsMin" => $infosEvenement['nbMinParticipants'],
            "prixEvent" => $infosEvenement['tarifEvenement'],
            "description" => $infosEvenement['descEvenement'],
            "debutEvent" => "$debutEvent",
            "finEvent" => "$finEvent",
            "idAdresse" => $lastIdAdresse
            );
        $this->executerRequete($evenement, $paramsEvenement);
        $lastIdEvenement = $this->getLastIdEvent();
        
        // On fait le lien avec le sport
        foreach ($infosEvenement["sportsAssocies"] as $sportsAssocies) {
            $reqIdSport = "SELECT idSport FROM SPORT WHERE nomSport = :nomSport";
            $paramsReqIdSport = array("nomSport" => $sportsAssocies);
            $res = $this->executerRequete($reqIdSport, $paramsReqIdSport);
            $fetchRes = $res->fetch();
            $idSport = $fetchRes["idSport"];
            $linkEvtSport = "INSERT INTO REGROUPER VALUES (:idEvent, :idSport) ";
            $paramsLinkEvtSport = array("idEvent" => $lastIdEvenement, "idSport" => $idSport);
            $this->executerRequete($linkEvtSport, $paramsLinkEvtSport);
        }
        
        // Enfin, on fait le lien entre l'événement et l'organisateur
        $linkEvtOrg = "INSERT INTO ORGANISER VALUES(:idOrganisateur, :idEvent)";
        $paramsLinkEvtOrg = array("idOrganisateur" => $idOrganisateur, "idEvent" => $lastIdEvenement);
        $insertLinkEvtOrg = $this->executerRequete($linkEvtOrg, $paramsLinkEvtOrg);
        return $insertLinkEvtOrg;
    }
    
    /**
     * GetLastIdEvent
     * 
     * Permet de récupérer le dernier ID de l'événement inséré dans la table
     * @return int
     */
    public function getLastIdEvent() {
        return $this->getLastId("idEvent", "EVENEMENT");
    }
    
    /**
     * GetFirstImageEvent
     * 
     * Permet de récupérer le premier image d'un événement (image insérée lors de l'inscription)
     * @param type $idEvent
     * @return type
     */
    public function getFirstImageEvent($idEvent) {
        $reqImageEvent = "SELECT nomImage, cibleImage FROM IMAGE, CONTENIR WHERE CONTENIR.idEvent = :idEvent AND CONTENIR.idImage = IMAGE.idImage";
        $paramsReqImageEvent = array("idEvent" => $idEvent);
        $resImageEvent = $this->executerRequete($reqImageEvent, $paramsReqImageEvent);
        return $infosImage  = $resImageEvent->fetch();
    }
    
    /**
     * GetAllImageEvent
     * 
     * @param type $idEvent
     * @return type
     */
    public function getAllImageEvent($idEvent) {
        $reqImageEvent = "SELECT nomImage, cibleImage FROM IMAGE, CONTENIR WHERE CONTENIR.idEvent = :idEvent AND CONTENIR.idImage = IMAGE.idImage";
        $paramsReqImageEvent = array("idEvent" => $idEvent);
        $resImageEvent = $this->executerRequete($reqImageEvent, $paramsReqImageEvent);
        return $infosImage  = $resImageEvent->fetchAll();
    }
    
    
    /**
     * 
     * @param type $idEvent
     * @return type
     */
    public function getPrimaryInfosEvent($idEvent) {
        $reqEvent = "SELECT nomEvent, nbParticipantsMax, nbParticipantsMin, prixEvent, descriptionEvent, debutEvent, finEvent FROM EVENEMENT WHERE idEvent = :idEvent ";
        $paramsReqEvent = array("idEvent" => $idEvent);
        $resEvent = $this->executerRequete($reqEvent, $paramsReqEvent);
        return $infosEvenement = $resEvent->fetch();
    }
    
    
    /**
     * 
     * @param type $idEvent
     * @return type
     */
    public function getLinkedSports($idEvent) {
        $reqSports = "SELECT nomSport FROM SPORT, REGROUPER WHERE REGROUPER.idEvent = :idEvent AND REGROUPER.idSport = SPORT.idSport";
        $paramReqSports = array("idEvent" => $idEvent);
        $resSports = $this->executerRequete($reqSports, $paramReqSports);
        return $infosSports = $resSports->fetchAll(PDO::FETCH_COLUMN);
    }
    
    /**
     * 
     * @param type $idEvent
     * @return type
     */
    public function getLinkedLocation($idEvent) {
        $reqVille = "SELECT numVoieAdresse, nomVoieAdresse, cptAdresse, codePostalAdresse, villeAdresse, dptAdresse, regionAdresse, paysAdresse FROM ADRESSE, EVENEMENT WHERE EVENEMENT.idEvent = :idEvent AND EVENEMENT.idAdresse = ADRESSE.idAdresse";
        $paramReqVille = array("idEvent" => $idEvent);
        $resVille = $this->executerRequete($reqVille, $paramReqVille);
        return $infoVille = $resVille->fetch();
    }
    
    public function getOrganisateur($idEvent) {
        $reqOrganisateur = "SELECT nomOrganisateur, typeOrganisateur, nomRef, prenomRef FROM ORGANISATEUR, ORGANISER WHERE ORGANISER.idEvent = :idEvent AND ORGANISER.idOrganisateur = ORGANISATEUR.idOrganisateur";
        $paramReqOrganisateur = array("idEvent" => $idEvent);
        $resOrganisateur = $this->executerRequete($reqOrganisateur, $paramReqOrganisateur);
        return $infoOrganisateur = $resOrganisateur->fetch(); 
    }
    
    
    public function getInfosEventVignette($idEvent) {
        // On récupère la première image
        $infosImage = $this->getFirstImageEvent($idEvent);
        // On récupère les informations  de l'événement
        $infosEvenement = $this->getPrimaryInfosEvent($idEvent);
        // On récupère les sports concernés
        $infosSports = $this->getLinkedSports($idEvent);
        // On récupère la ville concernée
        $infoVille = $this->getLinkedLocation($idEvent);
        // On récupère l'organisateur
        $infoOrganisateur = $this->getOrganisateur($idEvent);
        
        return array("idEvent" => $idEvent,
                     "nomImage" => $infosImage["nomImage"],
                     "nomOrganisateur" => $infoOrganisateur["nomOrganisateur"],
                     "cibleImage" => $infosImage["cibleImage"],
                     "nomEvenement" => $infosEvenement["nomEvent"],
                     "debutEvenement" => $infosEvenement["debutEvent"],
                     "sportsAssocies" => $infosSports,
                     "ville" => $infoVille["villeAdresse"]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
    }
    
    
    
    public function getListEvent() {
        $reqListEvent = "SELECT idEvent FROM EVENEMENT";
        $res = $this->executerRequete($reqListEvent);
        return $res->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    
    
    
    public function getInfosEvent($idEvent) {
        $infosEvent = $this->getPrimaryInfosEvent($idEvent);
        $infosImage = $this->getAllImageEvent($idEvent);
        $infosSport = $this->getLinkedSports($idEvent);
        $infosLocation = $this->getLinkedLocation($idEvent);
        $infosOrganisateur = $this->getOrganisateur($idEvent);
        
        return array("infosEvent" => $infosEvent,
                     "imagesEvent" => $infosImage,
                     "sportsAssocies" => $infosSport,
                     "localisation" => $infosLocation,
                     "infosOrganisateur" =>  $infosOrganisateur);
    }
    
    public function preInscrireMembre($idEvent, $login) {
        // Je récupère l'ID du participant
        $participant = new Participant();
        $resParticipant = $participant->getParticipant($login);
        $idParticipant = $resParticipant["idParticipant"];
        
        // J'insère dans la table inscrire 
        $reqPreInscrire = "INSERT INTO INSCRIRE VALUES (:idParticipant, :idEvent, 'PI')";
        $paramsReqPreInscrire = array("idParticipant" => $idParticipant, "idEvent" => $idEvent);
        if ($this->executerRequete($reqPreInscrire, $paramsReqPreInscrire)) { return true; } else { return false; }
    }
    
    public function validerInscriptionMembre($idEvent, $login) {
        // Je récupère l'ID du participant
        $participant = new Participant();
        $resParticipant = $participant->getParticipant($login);
        $idParticipant = $resParticipant["idParticipant"];
        
        // Je modifie la table inscrire
        $reqValiderInscriptionMembre = "UPDATE INSCRIRE SET statutInscription = 'I' WHERE idParticipant = :idParticipant AND idEvent = :idEvent";
        if ($this->executerRequete($reqValiderInscriptionMembre, array("idParticipant" => $idParticipant, "idEvent" => $idEvent))) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function refuserInscriptionMembre($idEvent, $login) {
        // Je récupère l'ID du participant
        $participant = new Participant();
        $resParticipant = $participant->getParticipant($login);
        $idParticipant = $resParticipant["idParticipant"];
        
        // Je modifie la table inscrire
        $reqValiderInscriptionMembre = "UPDATE INSCRIRE SET statutInscription = 'R' WHERE idParticipant = :idParticipant AND idEvent = :idEvent";
        if ($this->executerRequete($reqValiderInscriptionMembre, array("idParticipant" => $idParticipant, "idEvent" => $idEvent))) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     * 
     * @param type $motCle
     * @return type
     */
    public function getListEventSearched($motCle) {
        $req = "SELECT idEvent FROM EVENEMENT WHERE nomEvent LIKE '%$motCle%'";
        $res = $this->executerRequete($req);
        $resultatRecherche = $res->fetchAll(PDO::FETCH_COLUMN, 0);
        return $resultatRecherche;
    }
    
    
    public function getListEventParSport($idSport) {
        $req = "SELECT idEvent FROM REGROUPER WHERE REGROUPER.idSport = :idSport";
        $res = $this->executerRequete($req, array("idSport" => $idSport));
        $resultat = $res->fetchAll(PDO::FETCH_COLUMN, 0);
        return $resultat;
    }
        
}
