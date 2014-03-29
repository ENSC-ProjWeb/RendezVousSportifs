<?php
/**
 * Fichier de configuration du contrôleur
 *
 */

include "listerFichiers.php";

/* -------------------------------- PARAMETRES CONSTANTS GENERAUX --------------------------- */

// Titre de l'application
define('TITLE', 'RVS - RendezVousSportifs');

// Paramètres BDD
define('SGBD', 'mysql');
define('LOGIN', 'root');
define('PASSWORD', '');
define('HOST', '127.0.0.1');
define('BASE', 'bdprojetweb');
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
$models = listerFichiers("model/*.model.php"); // contient les modèles pour l'accès aux données


/* ------------------------------ PARAMETRES ACTIONS ------------------------------- */

// Action initiale
$initAct = 'initialiser';

// Action si enchaînement invalide
$falseAct = 'enchainementInvalide';


/* ------------------------------ PARAMETRES ETATS ------------------------------------ */

$initState = 'nonConnecte_accueil';

$states = array();

/*************************
 *  ETAT EN NON CONNECTE *
 *************************/

$states['nonConnecte_accueil'] = array('displayTpl' => 'tplPrincipal',
    'allowedActs' => array('initialiser', 'inscrire', 'seConnecter', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['nonConnecte_enregistrement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'validerInscription', 'inscrire', 'seConnecter', 'consulterListeEvenementsParSport'));

$states['nonConnecte_consultationEvenement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'inscrire', 'seConnecter', 'consulterListeEvenementsParSport'));

$states['nonConnecte_consultationResultatRecherche'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'inscrire', 'seConnecter', 'consulterEvenement', 'consulterListeEvenementsParSport'));

$states['nonConnecte_consultationListeEvenementParSport'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'inscrire', 'seConnecter', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

/*************************
 *  ETAT EN PARTICIPANT  *
 *************************/

$states['connecteParticipant_accueil'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['connecteParticipant_consultationEvenement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'poster', 'inscrireEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['connecteParticipant_consultationResultatRecherche'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'consulterEvenement', 'consulterListeEvenementsParSport', 'rechercherEvenement'));

$states['connecteParticipant_consultationListeEvenementParSport'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'inscrire', 'seConnecter', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

/*************************
 *  ETAT EN ORGANISATEUR  *
 *************************/

$states['connecteOrganisateur_creationEvenement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'validerCreationEvenement', 'consulterListeInscriptionsEnAttente', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['connecteOrganisateur_accueil'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'creerEvenement', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport', 'consulterListeInscriptionsEnAttente'));

$states['connecteOrganisateur_consultationEvenement'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'poster', 'consulterListeInscriptionsEnAttente', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['connecteOrganisateur_consultationResultatRecherche'] = array('displayTpl' => 'tplPrincipal',
        'allowedActs' => array('initialiser', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));

$states['connecteOrganisateur_consultationInscriptionsEnAttente'] = array('displayTpl' => "tplPrincipal",
        "allowedActs" => array('initialiser', 'consulterListeInscriptionsEnAttente', 'validerInscriptionEvenement', 'refuserInscriptionEvenement', 'consulterEvenement', 'rechercherEvenement', 'consulterListeEvenementsParSport'));


