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
        <h3> Bienvenue <?php echo $dataView["infosOrganisateur"]['nomOrganisateur']; ?> </h3>
        <table>
            <tr>
                <td><a href='index.php?consulterEvenementsEnCours'><?php echo $dataView["infosOrganisateur"]['nbEventPending']; ?> &eacute;v&eacute;nement(s) en cours</a></td>
            </tr>
            <tr>
                <td><a href="index.php?consulterEvenementsATraiter"><?php echo $dataView["infosOrganisateur"]['nbSubscribing']; ?> inscriptions en traitement</td>
            </tr>
            <tr>
                <td><a href="index.php?action=creerEvenement">Nouvel &eacute;v&eacute;nement</a> |
                    <a href="index.php?action=consulterCompte"/>Mon compte</a></td>
            </tr>
            <tr>
                <td><a href="index.php?action=seDeconnecter">D&eacute;connexion</a></td>
            </tr>
        </table>
</div>

<?php include $views['menuGeneral'];?>