<?php

/* Fonction listerFichiers
 * Fonction pour lister les fichiers d'un répertoire
 * Prend en paramètre le répertoire sous les formes suivantes : 
 *  - "nomRep/*.typeFichier.terminaisonFichier
 *  - "nomRep/*.terminaisonFichier
 * Retourne un tableau indicé de la forme : $res['nomFichier'] = 'emplacement'
 */

function listerFichiers($maskPattern)
{
    $list = glob($maskPattern); // on récupère les fichiers et répertoires selon le masque saisi en paramètre
    $res = array();             // tableau retourné
    foreach($list as $element)
    {
        $elements = explode(".", $element);
        $nomElements = explode("/", $elements[0]);
        $nomElement = $nomElements[1];
        $res[$nomElement] = $element;  
    }
    return $res;
}
