<?php include $views['consultationEvenementGlobal']; ?>
<br/>
<fieldset>
    <table>
        <tr>
            <td><?php
                if ($_SESSION['state'] == "connecteParticipant_consultationEvenement") {
                    if ($statut === NULL) {
                    echo "<a href='index.php?action=inscrireEvenement&idEvent=$idEvent'> S'inscrire </a>";
                    } elseif ($statut === "PI") {
                        echo "Inscrit";
                    } elseif ($statut === "I") {
                        echo "Accept&eacute;";
                    } else {
                        echo "Refus&eacute;";
                    }
                }
                ?></td>

            <td><form method="POST" action="index.php?action=posterMessage">
                    <textarea cols="50" rows="4" placeholder="Saissez votre message..."></textarea>
                <input type="submit" value="Poster"/></td>
            </form>
        </tr>
    </table>
</fieldset>

