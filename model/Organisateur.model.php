<?php

/**
 * Modèle Organisateur
 *
 * @author Guillaume
 * @version 1.0.0
 */

class Organisateur extends Modele {

    /**
     * Insertion d'organisateur
     * 
     * Insère les infos nécessaires à l'organisateur dans la base de données
     * @param string $login login de l'utilisateur 
     * @param array $infosOrg tableau contenant les infos de l'organisateur
     * @param array $infosLoc tableau contenant les infos de localisation
     *
     */
    public function insertOrganisateur($infosGlob, $infosOrg, $infosLoc) {
        
        // Instanciation des modèles nécessaires
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();

        // Insertion des infos progressivement
        $utilisateur->insertUtilisateur($infosGlob);
        $idAdresse = $adresse->insertAdresse($infosLoc);
        $reqOrganisateur = "INSERT INTO ORGANISATEUR VALUES ('',:nomOrg, :typeOrg, :nomRef, :prenomRef, :telRef, :mailRef, :loginUser, :idAdresse)";
        $paramsOrganisateur = array(
                    "nomOrg" => $infosOrg["nomOrganisation"],
                    "typeOrg" => $infosOrg["typeOrganisation"],
                    "nomRef" => $infosOrg["nomRef"],
                    "prenomRef" => $infosOrg["prenomRef"],
                    "telRef" => $infosOrg["numTelRef"],
                    "mailRef" => $infosOrg["mailRef"],
                    "loginUser" => $infosGlob["login"],
                    "idAdresse" => $idAdresse);
        $this->executerRequete($reqOrganisateur, $paramsOrganisateur);
        $updUser = "UPDATE UTILISATEUR SET telUser = :telUser, descUser = :descUser WHERE loginUser = :loginUser";
        return $this->executerRequete($updUser, array("telUser" => $infosOrg["numTelOrg"], "descUser" => $infosOrg["descOrg"], "loginUser" => $infosGlob["login"]));
       
    }
    
    /**
     * Get Organisateur
     * 
     * Permet de récupérer les infos d'un organisateur à partir d'un login
     * 
     * @param string $login login saisi par l'utilisateur
     * @return array avec les informations sur l'organisateur
     */
    public function getOrganisateur($login) {
        $req = "SELECT * FROM ORGANISATEUR WHERE loginUser = :login";
        $infos = $this->executerRequete($req, array("login" => $login));
        return $infos->fetch();
    }
    
    /**
     * Get Nb Evenement En Cours
     * 
     * Retourne le nombre d'événements en cours pour un organisateur
     * 
     * @param string $login chaîne de caractères correspondant au login de l'organisateur
     * @return int correspondant aux nombres d'événéments en cours
     */
    public function getNbEvenementEnCours($login) {
        $req = "SELECT COUNT( ORGANISER.idEvent ) AS NBEVENTENCOURS FROM ORGANISER, EVENEMENT, ORGANISATEUR WHERE ORGANISER.idEvent = EVENEMENT.idEvent AND ORGANISER.idOrganisateur = ORGANISATEUR.idOrganisateur AND ORGANISATEUR.loginUser = :login";
        $infos = $this->executerRequete($req, array("login" => $login));
        $res = $infos->fetch();
        return ($res["NBEVENTENCOURS"] !== 0 ) ? $res["NBEVENTENCOURS"] : 0;
    }
    
    /**
     * Get Nb Inscription En Cours
     * 
     * Retourne le nombre d'inscriptions à traiter (pré-inscrit) pour les événements d'un organisateur donné
     * @param string $login login du participant
     * @return int nombre d'inscriptions pendantes
     */
    public function getNbInscriptionEnCours($login) {
        $req = "SELECT COUNT(statutInscription) FROM INSCRIRE, EVENEMENT WHERE INSCRIRE.idEvent = (SELECT idEvent FROM ORGANISER, ORGANISATEUR WHERE ORGANISER.idOrganisateur = ORGANISATEUR.idOrganisateur AND ORGANISATEUR.loginUser = :login) AND statutInscription = 'PI' AND debutEvent >= CURDATE()";
        $infos = $this->executerRequete($req, array("login" => $login));
        $res = $infos->fetch();
        return ($res["COUNT(idEvent)"] !== NULL ) ? $res["COUNT(idEvent)"] : 0;
    }
}
