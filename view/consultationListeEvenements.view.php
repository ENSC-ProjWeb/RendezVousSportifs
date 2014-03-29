<?php
/**
 * Vue accueil
 * 
 * @author: Guillaume CARAYON
 * @version: 1.0.0
 * 
 */
echo $dataView['message'];
?>
<table width="150%">
    <?php
    $infosEvent = $dataView["infosEvent"];
    if (!empty($infosEvent)) {
        foreach ($infosEvent as $infoEvent) {
            $idEvent = $infoEvent["idEvent"];
            $nomImage = $infoEvent["nomImage"];
            $image = $infoEvent["cibleImage"];
            $nomEvenement = $infoEvent["nomEvenement"];
            $debutEvenement = $infoEvent["debutEvenement"];
            $sportsAssocies = $infoEvent["sportsAssocies"];
            $ville = $infoEvent["ville"];
            $nomOrganisateur = $infoEvent["nomOrganisateur"];
            echo "<tr>
                    <td rowspan='4' width='250px'><a href=index.php?action=consulterEvenement&idEvent=$idEvent><img src=$image alt=$nomImage width='250px'/></a></td>
                    <td><a href='index.php?action=consulterEvenement&idEvent=$idEvent'>$nomEvenement</a></td></tr>";
            echo "<tr><td>";
            for ($i = 0; $i < count($sportsAssocies); $i++) {
                echo "$sportsAssocies[$i] ";
            }
            echo "</td></tr>";
            echo "<tr><td>Le $debutEvenement &agrave; $ville</td></tr>";
            echo "<tr><td>Par $nomOrganisateur</td></tr>";
        }
    }
    ?>
</table>


