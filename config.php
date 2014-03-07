<?php
/**
 * Fichier de configuration du contrôleur
 * 
 * @author: Gabriel BELLAKHDAR
 * @author: Guillaume CARAYON
 * 
 * @todo: compléter la liste des états
 */

include "listerFichiers.php";

/* -------------------------------- PARAMETRES CONSTANTS GENERAUX --------------------------- */

// Titre de l'application
define('TITLE', 'ProjetSiteWebSport');

// Paramètres BDD
define('SGBD', 'monSGBD');
define('LOGIN', 'monLogin');
define('PASSWORD', 'monPassword');
define('HOST', 'monHost');
define('BASE', 'maBase');
define('DNS', SGBD.':host='.HOST.';dbname='.BASE);


// Configuration de l'affichage des erreurs/warning de php
// En phase de développement :
ini_set("error_reporting", E_ALL ^ E_NOTICE); // afficher toutes les erreurs sauf les notices
// En phase de release :
// ini_set("error reporting", 0);


/* ------------------------------ PARAMETRES EMPLACEMENT --------------------------- */

// Définition des tableaux d'emplacement [ array["nomfichier"] = "rep/nomfichier.tf" ]
$tpls = listerFichiers("tpl/*.tpl.php");      // contient les templates
$views = listerFichiers("view/*.view.*");     // contient les fragments de templates (vues)
$acts = listerFichiers("action/*.act.php");   // contient les fichiers d'actions
$css = listerFichiers("css/*.css");           // contient les fichiers de style
$libs = listerFichiers("lib/*.lib.php");      // contient les fonctions utilitaires


/* ------------------------------ PARAMETRES ACTIONS ------------------------------- */

// Action initiale
$initAct = 'initialiser';

// Action si enchaînement invalide
$falseAct = 'enchainementInvalide';


/* ------------------------------ PARAMETRES ETATS ------------------------------------ */

$initState = 'nonConnecte_accueil';

$states = array();

$states['nonConnecte_accueil'] = array('displayTpl' => 'tplPrincipal',
    'allowedActs' => array('initialiser', 'inscrire'));

$states['nonConnecte_enregistrement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'validerInscription'));


