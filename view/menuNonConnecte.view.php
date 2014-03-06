<?php
    /**
     * Vue menu non connecté
     * 
     * @author: Guillaume CARAYON
     * @version: 1.0.0.
     */
?>

<!-- Zone pour la connexion -->
<div id='zoneConnexion'>
    <form method='POST' action='index.php?action=seConnecter'>
        <h3> Connectez-vous </h3>
        <table>
            <tr>
                <td><input type='text' size='25' name='login' id='login' placeholder="Login" required/></td>
            </tr>
            <tr>
                <td><input type='password' size='25' name='password' id='password' placeholder="Mot de passe" required/></td>
            </tr>
            <tr>
                <td><a href="index.php?action=inscrire">S'inscrire</a></td>
                <td><input type="submit" value="Se connecter" name="btnSeConnecter" id="btnSeConnecter"/></td>
            </tr>
        </table>
    </form>
</div>

<?php include $views['menuGeneral'];?>


