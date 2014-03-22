<?php

/**
 * Modèle Image
 *
 * @author Guillaume CARAYON
 */
class Image extends Modele {

    /**
     * Insertion d'image utilisateur
     * 
     * Permet d'insérer les informations concernant les images des utilisateurs
     * 
     * @param string $login login de l'utilisateur
     * @param string $nomImage nom de l'image
     * @param string $locImage emplacement de l'image sur le serveur
     * 
     * @return un objet PDO Statement
     * 
     */
    public function insertImageUtilisateur($login, $nomImage, $locImage) {
        // Insertion de l'image dans la base de données Image
        $reqImage = "INSERT INTO IMAGE VALUES ('',:nomImage, :cibleImage)";
        $paramsImage = array(
            "nomImage" => $nomImage,
            "cibleImage" => $locImage
        );
        $this->executerRequete($reqImage, $paramsImage);
        // Lien entre l'image et l'utilisateur
        $lastId = $this->getLastId("idImage", "IMAGE");    
        $reqImageUser = "UPDATE UTILISATEUR SET idImage = :idAdd WHERE loginUser = :login";
        $paramsImageUser = array("login" => $login, "idAdd" => $lastId);
        $insertImageUser = $this->executerRequete($reqImageUser, $paramsImageUser);
        return $insertImageUser;
    }
    
    /**
     * Insertion d'image pour les événements
     * 
     * Permet d'insérer les images pour les événements créés
     * 
     * @param int $idEvenement id de l'événement
     * @param string $nomImage nom de l'image
     * @param string $locImage localisation de l'image
     * @return un objet de PDO Statement
     */
    public function insertImageEvenement($idEvenement, $nomImage, $locImage) {
        // Insertion de l'image dans la base de données Image
        $reqImage = "INSERT INTO IMAGE VALUES('', :nomImage, :cibleImage)";
        $paramsImage = array(
            "nomImage" => $nomImage,
            "cibleImage" => $locImage
        );
        $this->executerRequete($reqImage, $paramsImage);
        // Lien entre l'image et l'événement
        $lastId = $this->getLastId("idImage", "IMAGE");
        $reqImageEvent = "INSERT INTO CONTENIR VALUES(:idEvent, :idImage)";
        $paramsReqImageEvent = array (
            "idEvent" => $idEvenement,
            "idImage" => $lastId
            );
        $insertImageEvent = $this->executerRequete($reqImageEvent, $paramsReqImageEvent);
        return $insertImageEvent;
    }
}
