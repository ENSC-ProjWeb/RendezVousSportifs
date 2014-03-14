<?php
    /**
     * Vue menu connecté organisateur
     * 
     * @author: Guillaume CARAYON
     * @version: 1.0.0.
     */
?>

<!-- Zone pour la connexion -->
<div id='zoneConnexion'>
        <h3> Bienvenue <?php echo $dataView['nomOrganisation']; ?> </h3>
        <table>
            <tr>
                <td><a href='index.php?consulterEvenementsEnCours'><?php echo $dataView['nbEventPending']; ?> &eacute;v&eacute;nement(s) en cours</a></td>
            </tr>
            <tr>
                <td><a href="index.php?consulterEvenementsATraiter"><?php echo $dataView['nbSubscribing']; ?> inscriptions en traitement</td>
            </tr>
            <tr>
                <td><a href="index.php?action=creerEvenements">Cr&eacute;er un &eacute;v&eaucte;nement</a> |
                <a href="index.php?action=consulterCompte"/>Mon compte</td>
            </tr>
        </table>
</div>

<?php include $views['menuGeneral'];?>