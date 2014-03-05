<?php

/* Nom : initialiser
 * Rôle : Initialisation de la page d'accueil
 * Réalisé par : Guillaume CARAYON
 * Création le : 3/03/2014
 * Modifications :
 *      - 3/03/2014 : création
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
$dataView['zoneCentrale']=$views['accueilNonConnecte'];
$dataView['css']=$css['stylePrincipal'];

// Enregistrement des donnees de la vue dans la session
$_SESSION['dataView']=$dataView;

?>  
