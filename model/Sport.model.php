<?php

/**
 * Modèle Adresse
 *
 * @author Guillaume
 */

class Sport extends Modele {
    
    /**
     * 
     * @return tableau contenant la liste des sports
     */
    public function getListSports() {
        $reqSports = "SELECT nomSport FROM SPORT";
        $res = $this->executerRequete($reqSports);
        return $res->fetchAll();
    }
}
