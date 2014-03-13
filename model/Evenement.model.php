<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include $models["Modele"];
        
class Evenement extends Modele
{
    public function insertEvenementOrganisateur($paramsEvenement)
    {
        $evenement = "INSERT INTO EVENEMENT VALUES ('', :nomevent, :nbparticipantmax, :nbparticipantmin, :prixevent, :descriptionevent, :debutevent, :finevent, :idadresse)";
        $paramsEvenement = array(
            "nomEvent" => $paramsEvenement['nomEvent'],
            "nbParticipantsMax" =>  $paramsEvenement['nbParticipantmax'],
            "nbParticipantsMin" => $paramsEvenement['nbParticipantsmin'],
            "prixEvent" => $paramsEvenement['prixEvent'],
            "descriptionEvent" => $paramsEvenement['descriptionEvent'],
            "debutEvent" => $paramsEvenement['debutEvent'],
            "finEvent" => $paramsEvenement['finEvent'],
            );
        
        $insertEvenement = executerRequete($evenement, $paramsEvenement);
       
        //Il faut faire un lien entre l'organisateur(ou les  participants) et les evenement qu'il a créé (auquels il participe)
        //Premièrement, les participants
    }
    
    public function infoEvenement($idEvent)
    {
        $infoEvent = "SELECT * FROM EVENEMENTS WHERE IdEvent = $idEvent";
        return $infoEvent;
    }
   
    public function imageEvent($infoEvent)
    {
        $infoEvent = "SELECT "
    }
}