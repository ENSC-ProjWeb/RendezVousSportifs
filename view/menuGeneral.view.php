<!-- Zone menu avec la liste des sports -->
<div id='zoneMenuSports'>
    <h3> Liste des sports </h3>
    <ul>
    <?php 
        foreach ($dataView['listeSports'] as $sport) {
            $nomSport = $sport['nomSport']; $idSport = $sport['idSport'];
            echo "<li><a href='index.php?action=consulterListeEvenementsParSport&idSport=$idSport'> $nomSport </a></li>";
        }
    ?>
        <li> <a href="index.php?action=consulterTousLesSports"> Autres sports... </a></li>
    </ul>
</div>

<!-- Zone calendrier -->
<div id='zoneCalendrier'>
    <h3> Calendrier </h3>
    <form method='POST' action='index.php?action=rechercherDansCalendrier'>
        <table>
            <tr> 
                <td><label for='fromDay'>Evénement du : </label></td>
                <td><input type='text' size='12' name='fromDay' id='fromDay' placeholder="(jj/mm/aaaa)"/></td>
            </tr>
            <tr>
                <td><label for='fromHourFromDay'> à partir de : </label></td> 
                <td><input type='text' size='2' name='fromHourFromDay' id='fromHourFromDay' />
                    <label for='fromMinuteFromDay'> h </label> <input type='text' size='2' name='fromMinuteFromDay' id='fromMinuteFromDay' /></td>
            </tr>
            <tr>
                <td colspan="2" class="btnSubmit"><input type='submit' value='Chercher !' name='btnCalendarSearch' id='btnCalendarSearch' /></td>
            </tr>
        </table>
    </form>
</div>

