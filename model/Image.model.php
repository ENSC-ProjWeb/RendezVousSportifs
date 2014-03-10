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
     */
    public function insertImageUtilisateur($login, $nomImage, $locImage) {
        // Insertion de l'image dans la base de données Image
        $reqImage = "INSERT INTO IMAGE VALUES (:nomImage, :cibleImage)";
        $paramsImage = array(
            "nomImage" => $nomImage,
            "cibleImage" => $locImage,
        );
        $insertImage = $this->executerRequete($reqImage, $paramsImage);
 

        // Lien entre l'image et l'utilisateur
        if ($insertImage) {
            $reqImageUser = "UPDATE UTILISATEUR SET idImage = (SELECT LAST_INSERT_ID() FROM IMAGE) WHERE loginUser = :login";
            $paramsImageUser = array("login" => $login);
            $insertImageUser = $this->executerRequete($reqImageUser, $paramsImageUser);
            return $insertImageUser;
        }

    }

}
