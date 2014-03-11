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
        $requeteUser = "INSERT INTO UTILISATEUR(loginUser, mdpUser, mailUser, telUser, descUser) VALUES (:login, :password, :mail, :tel, :desc)";
        $paramsUser = array(
            "login" => $infosUser["login"],
            "password" => $infosUser["password"],
            "mail" => $infosUser["adresseMail"],
            "tel" => $infosUser["numTel"],
            "desc" => $infosUser["desc"]
        );
        $insertUser = $this->executerRequete($requeteUser, $paramsUser);
        return $insertUser;
    }

}
