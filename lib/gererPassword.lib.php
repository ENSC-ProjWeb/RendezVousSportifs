<?php

/**
 * Gestion des mots de passes
 * 
 * Ensemble de fonctions permettant la gestion des mots de passe dans la BDD
 */

/**
 * Hash Password
 * 
 * Permet de hasher en SHA-256 le mot de passe dans la BDD
 * 
 * @param string $password mot de passe à hasher
 * @return string le mot de passe hashé
 */
function hashPassword($password) {
    // Génère une chaîne de caractère de 256 bits aléatoire
    $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

    // Hash du mot de passe concaténé au salt selon SHA 256
    $hash = hash("sha256", $password . $salt);
    
    return $salt . $hash;
}

/**
 * Check Password
 * 
 * Permet de vérifier si le mot de passe saisi par l'utilisateur est valide
 * 
 * @param string $password mot de passe saisi par l'utilisateur
 * @param string $dbhash hash contenu dans la base de données 
 * @return bool indique si le mot de passe correspond
 */
function checkPassword($password, $dbhash)
{
  // get salt from dbhash
  $salt = substr($dbhash, 0, 64);
  
  // get the SHA256 hash
  $valid_hash = substr($dbhash, 64, 64);
  
  // hash the password
  $test_hash = hash("sha256", $password . $salt);
  
  // test
  return $test_hash === $valid_hash;
}