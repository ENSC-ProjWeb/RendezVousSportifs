<?php

/**
 * Créer événement
 * 
 * Action qui permet d'accéder à la page de création d'événement (etat connecteOrganisateur_creationEvenement)
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

// aucune donnée necessaire

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// pas d'action spécifique

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state']='connecteOrganisateur_creationEvenement';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - Créer un événement";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuConnecteOrganisateur'];
$dataView['zoneCentrale']=$views['creationEvenement'];
$dataView['css']=$css['stylePrincipal'];

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  


