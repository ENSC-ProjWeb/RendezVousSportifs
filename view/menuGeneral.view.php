<!-- Zone menu avec la liste des sports -->
<div id='zoneMenuSports'>
    <h3> Liste des sports </h3>
    <ul>
        <li><a href='#'>Football</a></li>
        <li><a href='#'>Rugby</a></li>
        <li><a href='#'>Natation</a></li>
        <li><a href='#'>Cricket</a></li>
        <li><a href='#'>Handball</a></li>
        <li><a href='#'>Autres sports...</a></li>
    </ul>
</div>

<!-- Zone calendrier -->
<div id='zoneCalendrier'>
    <h3> Calendrier </h3>
    <form method='POST' action='index.php?action=rechercherDansCalendrier'>
        <table>
            <tr> 
                <td><label for='fromDay'>Evénement du : (jj/mm/aaaa) </label></td>
                <td><input type='text' size='10' name='fromDay' id='fromDay'/></td>
            </tr>
            <tr>
                <td><label for='fromHourFromDay'> à partir de : </label></td> 
                <td><input type='text' size='2' name='fromHourFromDay' id='fromHourFromDay' />
                    <label for='fromMinuteFromDay'> h </label> <input type='text' size='2' name='fromMinuteFromDay' id='fromMinuteFromDay' /></td>
            </tr>
            <tr>
                <td rowspan="2"><input type='submit' value='Chercher !' name='btnCalendarSearch' id='btnCalendarSearch' /></td>
            </tr>
        </table>
    </form>
</div>
