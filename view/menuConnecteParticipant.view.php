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
        <h3> Bienvenue <?php echo $dataView['prenomParticipant']." ".$dataView['nomParticipant']; ?> </h3>
        <table>
            <tr>
                <td><?php echo $dataView['nbEventToCome']; ?> &eacute;v&eacute;nement(s) à venir</td>
            </tr>
            <tr>
                <td><?php echo $dataView['nbEventWaiting']; ?> &eacute;v&eacute;nements en attente</td>
            </tr>
            <tr>
                <td><a href="index.php?action=consulterEvenementsCompte">Mes &eacute;v&eacute;nements</a> |
                <a href="index.php?action=consulterCompte"/>Mon compte</td>
            </tr>
        </table>
</div>

<?php include $views['menuGeneral'];?>