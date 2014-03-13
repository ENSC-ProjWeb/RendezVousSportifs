<?php

/**
 * Modèle Utilisateur
 */


class Utilisateur extends Modele {

    /**
     * Insertion d'utilisateur
     * 
     * Permet d'insérer les informations de l'utilisateur
     * Préférer une implémentation dans les méthodes d'insertion particulière d'organisateur
     * 
     * @param array $infosUser tableau contenant les informations de l'utilisateur 
     * @return un objet PDO Statement
     */
    public function insertUtilisateur($infosUser) {
        $requeteUser = "INSERT INTO UTILISATEUR(loginUser, mdpUser, mailUser) VALUES (:login, :password, :mail)";
        $paramsUser = array(
            "login" => $infosUser["login"],
            "password" => $infosUser["password"],
            "mail" => $infosUser["adresseMail"],
        );
        $insertUser = $this->executerRequete($requeteUser, $paramsUser);
        return $insertUser;
    }
    
    /**
     * Get Utilisateur
     * 
     * Permet de récupérer les informations d'un utilisateur à partir d'un login
     * @param string $login login saisi par l'utilisateur
     */
    public function getUtilisateur($login) {
        $requete = "SELECT * FROM UTILISATEUR WHERE loginUser = :login";
        $getUser = $this->executerRequete($requete, array("login" => $login));
        return $getUser->fetch();
    }

}
