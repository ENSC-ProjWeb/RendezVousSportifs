<?php

/**
     * Vue enregistrement
     * 
     * @author: Guillaume CARAYON
     * @version: 1.0.0
     * 
     */

?>
<h2> Enregistrement </h2>

<form method="POST" action="index.php?action=enregistrer">
    <table>
        <tr>
            <td><label for="typeInscription">Souhaitez-vous vous inscrire en tant que : </label></td>
            <td><input type="radio" name="typeCompte" id="chParticipant" value="participant"/>
                <label for="typeCompte"> Participant </label></td>
            <td><input type="radio" name="typeCompte" value="organisateur" id="chOrganisateur"/>
                <label for="typeCompte"> Organisateur </label></td>
        </tr>
    </table>
    
    
</form>
