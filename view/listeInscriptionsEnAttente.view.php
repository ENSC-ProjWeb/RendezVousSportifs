<table width="150%" border="1px">
    <thead>
    <th>Nom &eacute;v&eacute;nement</th>
    <th>Login</th>
    <th>Action</th>
    </thead>
<?php
foreach($dataView['eventPending'] as $eventPending) {
    $idEvent = $eventPending['idEvent'];
    $login = $eventPending['login'];
   echo "<tr>";
   echo "<td rowspan='2'><a href='index.php?action=consulterEvenement&idEvent=$idEvent'>".$eventPending['nomEvent']."</td>";
   echo "<td rowspan='2'>".$eventPending['login']."</td>";
   echo "<td><a href='index.php?action=validerInscriptionEvenement&idEvent=$idEvent&login=$login'> Valider </a></td><tr><td><a href='index.php?action=refuserInscriptionEvenement&idEvent=$idEvent&login=$login'> Refuser </td></tr>";
}
?>

