<?php

/**
 * Modèle Adresse
 *
 * @author Guillaume
 */

class Adresse extends Modele {

    /**
     * Insertion d'adresse
     * 
     * Permet d'insérer les informations concernant l'adresse
     * Préféré une implémentation dans les méthodes d'insertions de type de compte particulier
     * @param array $infosLoc tableau contenant les informations de localisation
     * @return un objet PDO Statement
     * 
     */
    public function insertAdresse($infosLoc) {
        $reqAdresse = "INSERT INTO ADRESSE VALUES('',:numVoie, :nomVoie, :cptVoie, :cpAdresse, :villeAdresse, :dptAdresse, :regionAdresse, :paysAdresse)";
        $params = array(
            "numVoie" => $infosLoc["numVoie"],
            "nomVoie" => $infosLoc["nomVoie"],
            "cptVoie" => $infosLoc["cptVoie"],
            "cpAdresse" => $infosLoc["cpAdresse"],
            "villeAdresse" => $infosLoc["villeAdresse"],
            "dptAdresse" => $infosLoc["dptAdresse"],
            "regionAdresse" => $infosLoc["regionAdresse"],
            "paysAdresse" => $infosLoc["paysAdresse"]);
        $insertAdresse = $this->executerRequete($reqAdresse, $params);
        return $insertAdresse;

    }
}