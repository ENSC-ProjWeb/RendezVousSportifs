<?php

/**
 * Inscrire
 * 
 * Action qui permet d'accéder à la page d'inscription (etat nonConnecte_enregistrement)
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

include $models["Sport"];

$sport = new Sport();

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// pas d'action spécifique

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state']='nonConnecte_enregistrement';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - S'inscrire";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuNonConnecte'];
$dataView['zoneCentrale']=$views['enregistrement'];
$dataView['css']=$css['stylePrincipal'];
$dataView['listeSports'] = $sport->getFiveTopSports();

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  


