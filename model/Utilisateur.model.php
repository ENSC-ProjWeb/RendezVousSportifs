<?php

/**
 * Modèle Utilisateur
 */

include $models["Modele"];


class Utilisateur extends Modele
{
    /**
     * Insertion d'utilisateur
     * 
     * Permet d'insérer les informations de l'utilisateur
     * Préférer une implémentation dans les méthodes d'insertion particulière d'organisateur
     * 
     * @param array $infosUser tableau contenant les informations de l'utilisateur 
     */
    public function insertUtilisateur($infosUser)
    {
        $sql = "INSERT INTO UTILISATEUR(loginUser, mdpUser, mailUser, telUser, descUser) VALUES (:login, :password, :mail, :tel, :desc)";
        $bdd = $this->getBdd();
        $insertUser = $bdd->prepare($sql);
        $insertUser->execute(
                array(
                    "login" => $infosUser["login"],
                    "password" => $infosUser["password"],
                    "mail" => $infosUser["adresseMail"],
                    "numTel" => $infosUser["tel"],
                    "desc" => $infosUser["desc"]
                ));
    }
}
