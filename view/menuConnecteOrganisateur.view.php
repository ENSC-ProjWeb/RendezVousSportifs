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
                <td colspan="2"><?php echo $dataView['nbEventPending']; ?> &eacute;v&eacute;nement(s) en cours</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $dataView['nbSubscribing']; ?> inscriptions en traitement</td>
            </tr>
            <tr>
                <td><a href="index.php?action=consulterEvenementsCompte">Mes &eacute;v&eacute;nements</a>
                <td><a href="index.php?action=consulterCompte"/>Mon compte</td>
            </tr>
        </table>
</div>

<?php include $views['menuGeneral'];?>