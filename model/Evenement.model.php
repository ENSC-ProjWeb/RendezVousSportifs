<?php

class Evenement extends Modele
{
    /**
     * 
     * @param type $infosEvenement
     * @param type $infosLoc
     * @param type $idOrganisateur
     * @return type
     * 
     * @todo FAIRE LE LIEN AVEC LE SPORT !
     */
    public function insertEvenement($infosEvenement, $infosLoc, $idOrganisateur)
    {
        // On insère l'adresse de l'événement
        $adresse = new Adresse();
        $adresse->insertAdresse($infosLoc);
        $lastIdAdresse = $this->getLastId("idAdresse", "ADRESSE");
        
        // On insère ensuite les informations concernant les événements
        $evenement = "INSERT INTO EVENEMENT VALUES ('', :nomEvent, :nbParticipantsMax, :nbParticipantsMin, :prixEvent, :description, STR_TO_DATE(:debutEvent, '%d/%m/%Y %k:%i' ), STR_TO_DATE(:finEvent, '%d/%m/%Y %k:%i'), :idAdresse)";
        $paramsEvenement = array(
            "nomEvent" => $infosEvenement['nomEvenement'],
            "nbParticipantsMax" =>  $infosEvenement['nbMaxParticipants'],
            "nbParticipantsMin" => $infosEvenement['nbMinParticipants'],
            "prixEvent" => $infosEvenement['tarifEvenement'],
            "description" => $infosEvenement['descEvenement'],
            "debutEvent" => $infosEvenement['debutEvent'],
            "finEvent" => $infosEvenement['finEvent'],
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
    
    public function getLastIdEvent() {
        return $this->getLastId("idEvent", "EVENEMENT");
    }
    
    public function getInfosEventVignette($idEvent) {
        // On récupère les images
        $reqImageEvent = "SELECT nomImage, cibleImage FROM IMAGE, CONTENIR WHERE CONTENIR.idEvent = :idEvent AND CONTENIR.idImage = IMAGE.idImage";
        $paramsReqImageEvent = array("idEvent" => $idEvent);
        $resImageEvent = $this->executerRequete($reqImageEvent, $paramsReqImageEvent);
        $infosImage  = $resImageEvent->fetch();
        
        // On récupère les informations  de l'événement
        $reqEvent = "SELECT nomEvent, debutEvent FROM EVENEMENT WHERE idEvent = :idEvent ";
        $paramsReqEvent = array("idEvent" => $idEvent);
        $resEvent = $this->executerRequete($reqEvent, $paramsReqEvent);
        $infosEvenement = $resEvent->fetch();
        
        // On récupère les sports concernés
        $reqSports = "SELECT nomSport FROM SPORT, REGROUPER WHERE REGROUPER.idEvent = :idEvent AND REGROUPER.idSport = SPORT.idSport";
        $paramReqSports = array("idEvent" => $idEvent);
        $resSports = $this->executerRequete($reqSports, $paramReqSports);
        $infosSports = $resSports->fetchAll(PDO::FETCH_COLUMN);
        
        // On récupère la ville concernée
        $reqVille = "SELECT villeAdresse FROM ADRESSE, EVENEMENT WHERE EVENEMENT.idEvent = :idEvent AND EVENEMENT.idAdresse = ADRESSE.idAdresse";
        $paramReqVille = array("idEvent" => $idEvent);
        $resVille = $this->executerRequete($reqVille, $paramReqVille);
        $infoVille = $resVille->fetch();
        
        // On récupère l'organisateur
        $reqOrganisateur = "SELECT nomOrganisateur FROM ORGANISATEUR, ORGANISER WHERE ORGANISER.idEvent = :idEvent AND ORGANISER.idOrganisateur = ORGANISATEUR.idOrganisateur";
        $paramReqOrganisateur = array("idEvent" => $idEvent);
        $resOrganisateur = $this->executerRequete($reqOrganisateur, $paramReqOrganisateur);
        $infoOrganisateur = $resOrganisateur->fetch(); 
        
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
        // On récupère les informations sur l'événement
        $infosEvent = "SELECT nomEvent, nbParticipantsMax, nbParticipantsMin, prixEvent, descEvent, debutEvent, finEvent FROM EVENEMENT WHERE idEvenement = :idEvenement "
    }
}