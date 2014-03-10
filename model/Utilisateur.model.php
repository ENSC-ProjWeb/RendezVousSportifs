<?php

/**
 * Modèle Utilisateur
 */

include $models["Modele"];

class Utilisateur extends Modele
{
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
