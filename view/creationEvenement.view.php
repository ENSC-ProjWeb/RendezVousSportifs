<?php
/**
 * Vue création d'événement
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 * @todo: Essayer de placer en required les champs obligatoires (bug sinon avec la fonction afficher())
 */
?>


<!--<script type="text/javascript">
    function afficher()
    {
        var formOrganisateur = document.getElementById("formEnrOrganisateur");
        var formParticipant = document.getElementById("formEnrParticipant");
        var formGlobal = document.getElementById("globForm");
        if (document.getElementById("chParticipant").checked === true)
        {
            formGlobal.style.display = "block";
            formParticipant.style.display = "block";
            formOrganisateur.style.display = "none";
        }
        else
        {
            formGlobal.style.display = "block";
            formOrganisateur.style.display = "block";
            formParticipant.style.display = "none";
        }
    }
</script>-->

<h2> Cr&eacute;er votre &eacute;v&eacute;nement </h2>

<?php echo $dataView["message"]; ?>

<a href="index.php?action=initialiser"> Revenir &agrave; l'accueil </a> <br/><br/>

<form method="POST" action="index.php?action=validerCreationEvenement" enctype="multipart/form-data">
    <fieldset> 
        <legend> Descriptif de l'&eacute;v&eacute;nement </legend>
        <table>
            <tr>
                <td><label for="nomEvenement">Nom :</label></td>
                <td><input type="text" size="25" name="nomEvenement" id="nomOrganisation" value='<?php if (isset($_POST["nomEvenement"])) echo $_POST["nomEvenement"]; ?>' /></td>
            </tr>
            <tr>
                <td><label for='descEvenement'>Description :</td>
                <td><textarea rows="4" cols='50' name='descEvenement' placeholder='D&eacute;crivez votre &eacute;v&eacute;nement en quelques mots'> <?php if (isset($_POST['descEvenement'])) echo $_POST["descEvenement"];?></textarea></td> 
            </tr>
            <tr>
                <td><label for="uploadImageEvenement">Image de votre &eacute;v&eacute;nement</label></td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="2097152"/>
                    <input type="file" name="uploadImageEvenement" value='<?php if (isset($_FILES["uploadImageEvenement"])) echo $_FILES["uploadImageEvenement"]; ?>'/></td>
            </tr>
        </table>
    </fieldset>
    <br/>
    <fieldset>
        <legend> Informations concernant les participants </legend>
        <table>
            <tr>
                <td><label for='nbMinParticipants'>Nombre minimum :</label></td>
                <td><input type='number' min='0' max='9999' name='nbMinParticipants' value='<?php if (isset($_POST["nbMinParticipants"])) echo $_POST["nbMinParticipants"]; ?>' /></td>
            </tr>
             <tr>
                <td><label for='nbMaxParticipants'>Nombre maximum :</label></td>
                <td><input type='number' min='1' max='9999' name='nbMaxParticipants' value='<?php if (isset($_POST["nbMaxParticipants"])) echo $_POST["nbMaxParticipants"]; ?>' /></td>
            </tr> 
            <tr>
                <td><label for='tarifEvenement'>Tarif (TTC) :</label></td>
                <td><input type='number' min='0.00'> &euro;</td>
            </tr>
        </table>
    </fieldset>
    <Br/>
    <fieldset>
        <legend> Quand et o&ugrave; ?</legend>
        <h3> Quand ? </h3>
        <table>
            <tr>
                <td><label for='dateDebut'>D&eacute;but :</label></td>
                <td> Le <input type='date' name='dateDebut' placeholder='jj/mm/aaaa' value='<?php if (isset($_POST['dateDebut'])) echo $_POST['dateDebut']; ?>'/> &agrave; 
                    <input type='time' name='heureDebut' placeholder='hh:mm' value='<?php if (isset($_POST['heureDebut'])) echo $_POST['heureDebut']; ?>' /></td>
            </tr>
             <tr>
                <td><label for='dateArrivee'>Fin :</label></td>
                <td> Le <input type='date' name='dateFin' placeholder='jj/mm/aaaa' value='<?php if (isset($_POST['dateFin'])) echo $_POST['dateFin']; ?>'/> &agrave; 
                    <input type='time' name='heureFin' placeholder='hh:mm' value='<?php if (isset($_POST['heureFin'])) echo $_POST['heureFin']; ?>' /></td>
            </tr>
        </table>
        <br/>
        <h3> O&ugrave; ? </h3>
        <table>
            <tr>
                <td><input type="text" size="3" width="3" name="numVoie" placeholder="Num" value='<?php if (isset($_POST["numVoie"])) echo $_POST["numVoie"]; ?>'/>
                    <input type="text" size="50" width="97" name="nomVoie" placeholder="Rue, Voie, Boulevard..." value='<?php if (isset($_POST["nomVoie"])) echo $_POST["nomVoie"]; ?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" width="100" name="cptVoie" placeholder="B&acirc;timent, Appartement..." value='<?php if (isset($_POST["cptVoie"])) echo $_POST["cptVoie"]; ?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="5" width="10" name="cpAdresse" placeholder="Code Postal" value='<?php if (isset($_POST["cpAdresse"])) echo $_POST["cpAdresse"]; ?>'/>
                    <input type="text" size="50" width="90" name="villeAdresse" placeholder="Ville" value='<?php if (isset($_POST["villeAdresse"])) echo $_POST["villeAdresse"]; ?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" name="dptAdresse" placeholder="D&eacute;partement" value='<?php if (isset($_POST["dptAdresse"])) echo $_POST["dptAdresse"]; ?>'/>
                    <input type="text" size="50" name="regionAdresse" placeholder="R&eacute;gion" value='<?php if (isset($_POST["regionAdresse"])) echo $_POST["regionAdresse"]; ?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" width="100" name="paysAdresse" placeholder="Pays" value='<?php if (isset($_POST["paysAdresse"])) echo $_POST["paysAdresse"]; ?>'/></td>
            </tr>
        </table>    
    </fieldset>
<br/>
<input type="submit" value="Cr&eacute;er"/>
</form>
