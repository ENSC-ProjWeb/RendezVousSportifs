<?php

/**
 *  Lister les emplacements fichiers dans un tableau indicé avec les noms des fichiers
 * 
 * @author : Guillaume CARAYON
 * @version : 1.0.0
 * 
 * @params string $maskPattern  Chaîne de caractère de type "rep/*.tF.ext" ou "rep/*.ext"
 * @return tableau avec les emplacements des fichiers indicé avec les noms des fichiers 
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
