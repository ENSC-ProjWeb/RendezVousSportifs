<?php echo $dataView["message"]; ?>

<fieldset>
    <legend> Informations globales </legend>
    <table>
        <tr>
            <td> <?php echo $dataView['nomEvent']; ?> </td>
            <td rowspan="4"> <img src=<?php echo $dataView['empImagePrincipale']; ?> alt=<?php echo $dataView['nomImagePrincipale']; ?> width="250px"/> </td>
        </tr>
        <tr>
            <td><?php echo $dataView['descEvent']; ?></td>
        </tr>
        <tr>
            <td><?php foreach ($dataView['sportsAssocies'] as $sport) { echo $sport; } ?></td>
        </tr>
        <tr>
            <td>D&eacute;bute le : <?php echo $dataView['debutEvent']; ?><br/>
                Fini le : <?php if ($dataView['finEvent'] !== '0000-00-00 00:00:00') echo $dataView['finEvent']; else echo "Pas de date sp&eacute;cifi&eacute;";?></td>
        </tr>
        <tr>
            <td>Organis&eacute; par : <?php echo $dataView['nomOrganisateur']; ?></td>
        </tr>
    </table>
</fieldset>

<br/>

<fieldset>
    <legend> Tarifs et quota </legend>
    <table>
        <tr>
            <td> Tarif : </td>
            <td><?php echo $dataView['tarifEvent']; ?> &euro;</td>
        </tr>
        <tr> 
            <td>Nombre minimum de participant(s) :</td> 
            <td><?php echo $dataView['nbMinParticipants']; ?></td>
        </tr>
        <tr>
            <td>Nombre maximum de participant(s) :</td>
            <td><?php echo $dataView['nbMaxParticipants']; ?></td>
        </tr>
    </table>
</fieldset>

<br/>

<fieldset>
    <legend> O&ugrave; </legend>
    <?php echo $dataView['adresse']; ?>
</fieldset>
