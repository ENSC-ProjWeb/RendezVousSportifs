<?php

/**
 * Initialiser
 * 
 * Action qui initialise la page d'accueil (etat nonConnecte_accueil)
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * @todo: Tout va bien
 */

// -------------------------------------------------------
// Recuperer les donnees d'entree nécessaires à l'action
// -------------------------------------------------------

// aucune donnée necessaire

// -------------------------------------------------------
// Executer l'action
// ---------------------------------------------------------

// On nettoie les variables de session
$_SESSION=array();

// -------------------------------------------------------
// Definir le nouvel etat de l'application
// -------------------------------------------------------

$_SESSION['state']='nonConnecte_accueil';  

// -------------------------------------------------------
// Preparer les donnees de la vue resultante
// -------------------------------------------------------

// Definition des donnees structurelles de la vue
$dataView['title']=TITLE." - Accueil";
$dataView['zoneHaute']=$views['banniere'];
$dataView['zoneRecherche']=$views['recherche'];
$dataView['zoneMenu']=$views['menuNonConnecte'];
$dataView['zoneCentrale']=$views['accueil'];
$dataView['css']=$css['stylePrincipal'];

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  
