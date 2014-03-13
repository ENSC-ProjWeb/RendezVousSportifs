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
     * @return un objet PDO Statement
     */
    public function insertOrganisateur($infosGlob, $infosOrg, $infosLoc) {
        
        // Instanciation des modèles nécessaires
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();

        // Insertion des infos progressivement
        $utilisateur->insertUtilisateur($infosGlob);
        $insertAdresse = $adresse->insertAdresse($infosLoc);
        $reqOrganisateur = "INSERT INTO ORGANISATEUR VALUES ('',:nomOrg, :typeOrg, :nomRef, :prenomRef, :telRef, :mailRef, :loginUser, :idAdresse)";
        $paramsOrganisateur = array(
                    "nomOrg" => $infosOrg["nomOrganisation"],
                    "typeOrg" => $infosOrg["typeOrganisation"],
                    "nomRef" => $infosOrg["nomRef"],
                    "prenomRef" => $infosOrg["prenomRef"],
                    "telRef" => $infosOrg["numTelRef"],
                    "mailRef" => $infosOrg["mailRef"],
                    "loginUser" => $infosGlob["login"],
                    "idAdresse" => $insertAdresse["idAdresse"]);
        $insertOrganisateur = $this->executerRequete($reqOrganisateur, $paramsOrganisateur);
        return $insertOrganisateur;
    }
}
