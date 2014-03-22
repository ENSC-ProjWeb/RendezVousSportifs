<?php
    /**
     * Vue menu connecté participant
     * 
     * @author: Guillaume CARAYON
     * @version: 1.0.0.
     */
?>

<!-- Zone pour la connexion -->
<div id='zoneConnexion'>
        <h3> Bienvenue <?php echo $dataView["infosParticipant"]['prenomParticipant']." ".$dataView["infosParticipant"]['nomParticipant']; ?> </h3>
        <table>
            <tr>
                <td><?php echo $dataView["infosParticipant"]['nbEventToCome']; ?> &eacute;v&eacute;nement(s) à venir</td>
            </tr>
            <tr>
                <td><?php echo $dataView["infosParticipant"]['nbEventWaiting']; ?> &eacute;v&eacute;nements en attente</td>
            </tr>
            <tr>
                <td><a href="index.php?action=consulterEvenementsCompte">Mes &eacute;v&eacute;nements</a> |
                <a href="index.php?action=consulterCompte"/>Mon compte</td>
            </tr>
            <tr>
                <td><a href="index.php?action=initialiser">D&eacute;connexion</a></td>
            </tr>
        </table>
</div>

<?php include $views['menuGeneral'];?>