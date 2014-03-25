<?php

function definirNiveauDeConnexion($state) {
    $monEtat = explode('_', $state);
    $niveauConnexion = $monEtat[0];
    return $state;
}
?>