<?php

/**
 * Librairies de fonctions pour l'upload et la gestion des photos
 * 
 */

/**
 * Upload Photos
 * 
 * @author Guillaume CARAYON
 * @version 1.0.0
 * 
 * Photo qui gère l'envoie de la photo uploadé sur le répertoire correspondant dans le serveur
 * @param array $file : tableau $_FILE['nomFichier'] correspondant
 * @param type $rep : répertoire dans lequel doit être envoyé la photo
 * @return array tableau indicé "nomPhoto" qui correspond au nom de la photo et "empPhoto" qui correspond à l'emplacement de la photo sur le serveur
 * 
 */
function uploadPhotos($file, $rep) {

    // On définit la liste des extensions autorisées
    $extAutorisees = array("jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
        "gif" => "image/gif");

    // On définit ensuite un ensemble de vérifs sur le fichier
    if (!empty($file)) {
        if ($file['error'] <= 0) {
            if ($file['size'] <= 2097152) {
                $image = $file['name'];
                // On vérifie le type de l'image par rapport à son extension physique
                $extPresumees = explode('.', $image);
                $extPresumee = strtolower($extPresumees[1]);
                if (array_key_exists($extPresumee, $extAutorisees)) {
                    // Puis on vérifie par son type MIME
                    $infosImage = getimagesize($file['tmp_name']);
                    if ($infosImage['mime'] === $extAutorisees[$extPresumee]) {
                        // On peut uploader la photo sur le serveur
                        if (is_uploaded_file($file['tmp_name'])) {
                            $nomPhoto = md5(uniqid(rand(), true));
                            $nomFinal = "{$rep}./.{$nomPhoto}.{$extPresumee}";
                            if (move_uploaded_file($file['tmp_name'], $nomFinal)) {
                                return array("nomPhoto" => $nomPhoto,
                                    "empPhoto" => $nomFinal);
                            }
                        } else {
                            return FAIL_UPLOAD;
                        }
                    } else {
                        return UNMATCH_MIME_TYPE;
                    }
                } else {
                    return BAD_TYPE;
                }
            } else {
                return HEAVY_FILE;
            }
        } else {
            return ERROR_FILE;
        }
    } else {
        return EMPTY_FILE;
    }
}
