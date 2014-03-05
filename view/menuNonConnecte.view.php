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
                <td><label for='login'>Login : </label></td>
                <td><input type='text' size='25' name='login' id='login'/><br/></td>
            </tr>
            <tr>
                <td><label for='password'>Mot de passe : </label></td>
                <td><input type='password' size='25' name='password' id='password'><br/></td>
            </tr>
            <tr>
                <td><a href="index.php?action=inscrire">S'inscrire</a></td>
                <td><input type="submit" value="Se connecter" name="btnSeConnecter" id="btnSeConnecter"/></td>
            </tr>
        </table>
    </form>
</div>

<?php include $views['menuGeneral'];?>


