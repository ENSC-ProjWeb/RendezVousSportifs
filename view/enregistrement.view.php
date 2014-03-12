<?php
/**
 * Vue enregistrement
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.1
 * 
 * @todo: Essayer de placer en required les champs obligatoires (bug sinon avec la fonction afficher())
 */
?>


<script type="text/javascript">
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
</script>

<h2> Enregistrement </h2>

<?php echo $dataView["message"]; ?>

<a href="index.php?action=initialiser"> Revenir &agrave; l'accueil </a> <br/><br/>

<form method="POST" action="index.php?action=validerInscription" enctype="multipart/form-data">
    <fieldset>
        <legend> Mon type de compte </legend>
        <table>
            <tr>
                <td><label for="typeCompte">Souhaitez-vous vous inscrire en tant que : </label></td>
                <td><input type="radio" name="typeCompte" id="chParticipant" value="participant" onclick="afficher()" />
                    Participant </td>
                <td><input type="radio" name="typeCompte" value="organisateur" id="chOrganisateur" onclick="afficher()"/>
                    Organisateur</td>
            </tr>
        </table>
    </fieldset>
    <br/>
    
    <div id="globForm" style="display: none">
    <fieldset>
        <legend> Mes informations de connexion </legend>
        <table>
            <tr>
                <td><label for="login">Login :</label></td>
                <td><input type="text" size="25" name="login" id="login" placeholder="Pseudo" value='<?php if (isset($_POST["login"])) echo $_POST["login"]?>'/></td>
            </tr>
            <tr>
                <td><label for="password">Mot de passe :</label></td>
                <td><input type="password" size="25" name="password" id="password" placeholder="Mot de passe" oncopy='return false;' oncut='return false;' value='<?php if (isset($_POST["password"])) echo $_POST["password"];?>'/></td>
            </tr>
            <tr>
                <td><label for='confirmPassword'>Confirmez votre mot de passe :</label></td>
                <td><input type='password' size='25' name='confirmPassword' id='confirmPassword' onpaste='return false;' /></td>
            </tr>
            <tr>
                <td><label for="adresseMail">E-mail :</label></td>
                <td><input type="email" size="50" name="adresseMail" id="adresseMail" placeholder="exemple@monsite.com" oncopy='return false;' onpaste='return false;' value='<?php if (isset($_POST["adresseMail"])) echo $_POST["adresseMail"];?>' /></td>
            </tr>
            <tr>
                <td><label for="confirmMail">Confirmez votre adresse mail :</label></td>
                <td><input type="email" size="50" name="confirmMail"  /></td>
            </tr>
        </table>
    </fieldset>
    
    <br/>
    
    <div id='formEnrOrganisateur' style='display: none'>
        <fieldset> 
            <legend> Informations sur mon organisation </legend>
            <h3> Renseignements g&eacute;n&eacute;raux sur mon organisation </h3>
            <table>
                <tr>
                    <td><label for="nomOrganisation">Nom de l'organisation :</label></td>
                    <td><input type="text" size="25" name="nomOrganisation" id="nomOrganisation" value='<?php if (isset($_POST["nomOrganisation"])) echo $_POST["nomOrganisation"]; ?>' /></td>
                </tr>
                <tr>
                    <td><label>Type d'organisation :</label></td>
                    <td><input type='radio' name='typeOrganisation' value='CS' /> Club sportif
                        <input type='radio' name='typeOrganisation' value='CO'/> Club omnisport
                        <input type='radio' name='typeOrganisation' value='A'/> Autres </td>
                </tr>   
                <tr>
                    <td><label for='numTelOrg'>Num&eacute;ro de t&eacute;l&eacute;phone :</label></td>
                    <td><input type='tel' size='10' name='numTelOrg' value='<?php if (isset($_POST["numTelOrg"])) echo $_POST["numTelOrg"]; ?>' /></td>
                </tr> 
                <tr>
                    <td colspan='2'><label for='descOrg'>D&eacute;crivez-vous :</label></td>
                </tr>
                <tr>
                    <td colspan='2'><textarea rows='4' cols='50' name="descOrg"><?php if (isset($_POST["descOrg"])) echo $_POST["descOrg"]; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="uploadAvatarOrg">Photo de profil :</label></td>
                    <td><input type="hidden" name="MAX_FILE_SIZE" value="2097152"/>
                        <input type="file" name="uploadAvatarOrg" value='<?php if (isset($_FILES["uploadAvatarOrg"])) echo $_FILES["uploadAvatarOrg"]["name"];?>'/></td>
                </tr>
            </table>

            <h3> Renseignements g&eacute;n&eacute;raux sur le r&eacute;f&eacute;rent de mon organisation </h3>
            <table>
                <tr>
                    <td><label>Nom et pr&eacute;nom :</label></td>
                    <td><input type='text' size='25' placeholder="Pr&eacute;nom" name="nomRef" value='<?php if (isset($_POST["nomRef"])) echo $_POST["nomRef"];?>'/>
                        <input type='text' size='25' placeholder='Nom' name='prenomRef' value='<?php if (isset($_POST["prenomRef"])) echo $_POST["prenomRef"];?>'  /></td>
                </tr>
                <tr>
                    <td><label for='mailRef'>Adresse mail :</label></td>
                    <td><input type='mail' size='50' name='mailRef' placeholder="Si possible diff&eacute;rente de celle de l'organisation" value='<?php if (isset($_POST["mailRef"])) echo $_POST["mailRef"];?>' /></td>
                </tr>
                <tr>
                    <td><label for='numTelRef'>Num&eacute;ro de t&eacute;l&eacute;phone :</label></td>
                    <td><input type='tel' size='10' name='numTelRef' value='<?php if (isset($_POST["numTelRef"])) echo $_POST["numTelRef"];?>' /></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="formEnrParticipant" style="display:none">
        <fieldset>
            <legend> Mes informations </legend>
            <table>
                <tr>
                    <td><label>Pr&eacute;nom et nom:</label></td>
                    <td><input type='text' size='25' placeholder="Pr&eacute;nom" name="prenomParticipant" value='<?php if (isset($_POST["prenomParticipant"])) echo $_POST["prenomParticipant"];?>'/>
                        <input type='text' size='25' placeholder='Nom' name='nomParticipant' value='<?php if (isset($_POST["nomParticipant"])) echo $_POST["nomParticipant"];?>'/></td></td>
                </tr>
                <tr>
                    <td><label for="genre"> Genre : </label></td>
                    <td><input type="radio" name="genreParticipant" value="M"/> Homme
                        <input type="radio" name="genreParticipant" value="F"/> Femme
                </tr>
                <tr>
                    <td><label for="dateNaissanceParticipant"> Date de naissance : </label></td>
                    <td><input type="date" name="dateNaissanceParticipant" placeholder="jj/mm/aaaa" size='10' value='<?php if (isset($_POST["dateNaissanceParticipant"])) echo $_POST["dateNaissanceParticipant"];?>'/></td>
                </tr>
                <tr>
                    <td><label for='numTelPart'>Num&eacute;ro de t&eacute;l&eacute;phone :</label></td>
                    <td><input type='tel' size='10' name='numTelPart' value='<?php if (isset($_POST["numTelPart"])) echo $_POST["numTelPart"];?>'/></td>
                </tr> 
                <tr>
                    <td colspan='2'><label for='descPart'>D&eacute;crivez-vous :</label></td>
                </tr>
                <tr>
                    <td colspan='2'><textarea rows='4' cols='50' name='descPart' placeholder="Vos sports pr&eacute;f&eacute;r&eacute;s ? Vos loisirs autres ? Votre philosophie de vie ?"><?php if (isset($_POST["descPart"])) echo $_POST["descPart"];?></textarea></td>
                </tr>
                <tr>
                    <td><label for="uploadAvatarPart">Photo de profil : </label></td>
                    <td><input type="file" name="uploadAvatarPart" value='<?php if (isset($_FILES["uploadAvatarPart"])) echo $FILES["uploadAvatarPart"]["name"];?>'/></td>
                </tr>
            </table>
        </fieldset>
    </div>
    <br/>
    <fieldset>
        <legend> Ma localisation </legend>
        <em> Les informations que vous saisissez ici nous permettent de localiser au mieux les &eacute;v&eacute;nements proches de vous<br/></em>
        <table>
            <tr>
                <td><input type="text" size="3" width="3" name="numVoie" placeholder="Num" value='<?php if (isset($_POST["numVoie"])) echo $_POST["numVoie"];?>'/>
                    <input type="text" size="50" width="97" name="nomVoie" placeholder="Rue, Voie, Boulevard..." value='<?php if (isset($_POST["nomVoie"])) echo $_POST["nomVoie"];?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" width="100" name="cptVoie" placeholder="B&acirc;timent, Appartement..." value='<?php if (isset($_POST["cptVoie"])) echo $_POST["cptVoie"];?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="5" width="10" name="cpAdresse" placeholder="Code Postal" value='<?php if (isset($_POST["cpAdresse"])) echo $_POST["cpAdresse"];?>'/>
                    <input type="text" size="50" width="90" name="villeAdresse" placeholder="Ville" value='<?php if (isset($_POST["villeAdresse"])) echo $_POST["villeAdresse"];?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" name="dptAdresse" placeholder="D&eacute;partement" value='<?php if (isset($_POST["dptAdresse"])) echo $_POST["dptAdresse"];?>'/>
                    <input type="text" size="50" name="regionAdresse" placeholder="R&eacute;gion" value='<?php if (isset($_POST["regionAdresse"])) echo $_POST["regionAdresse"];?>'/></td>
            </tr>
            <tr>
                <td><input type="text" size="50" width="100" name="paysAdresse" placeholder="Pays" value='<?php if (isset($_POST["paysAdresse"])) echo $_POST["paysAdresse"];?>'/></td>
            </tr>
        </table>
    </fieldset>
    <br/>
    <input type="submit" value="S'enregistrer"/>
</div>

</form>
