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

class Organisateur extends Modele {
    
    /**
     * Insertion d'organisateur
     * 
     * Insère les infos nécessaires à l'organisateur dans la base de données
     * @param string $login login de l'utilisateur 
     * @param array $infosOrg tableau contenant les infos de l'organisateur
     * @param array $infosLoc tableau contenant les infos de localisation
     */
    
    public function insertOrganisateur($infosGlob, $infosOrg, $infosLoc)
    {
        $adresse = new Adresse();
        $utilisateur = new Utilisateur();
        
        $utilisateur->insertUtilisateur($infosGlob);
        $adresse->insertAdresse($infosLoc);
        
        $reqOrganisateur = "INSERT INTO ORGANISATEUR VALUES (:nomOrg, :typeOrg, :nomRef, :prenomRef, :telRef, :mailRef, :loginUser, :idAdresse)";
        $bdd = $this->getBdd();
        $insertOrganisateur = $bdd->prepare($reqOrganisateur);
        $insertOrganisateur->execute(array(
            "nomOrg" => $infosOrg["nomOrganisation"],
            "typeOrg" => $infosOrg["typeOrganisation"],
            "nomRef" => $infosOrg["nomRef"],
            "prenomRef" => $infosOrg["prenomRef"],
            "telRef" => $infosOrg["numTelRef"],
            "mailRef" => $infosOrg["mailRef"],
            "loginUser" => $infosGlob["login"],
            "idAdresse" => "(SELECT LAST_INSERT_ID() FROM ADRESSE)"
        ));
    }
}
