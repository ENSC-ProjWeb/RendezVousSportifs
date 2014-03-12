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

}
