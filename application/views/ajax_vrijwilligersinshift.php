<table>
<tr>
<th>Naam</th>
<th>e-mailadres</th>
</tr>
<?php
foreach ($shiften as $shift) {
    echo $shift->persoonId;
    // foreach ($shift->persoon as $persoon) {
    //     echo "<tr><td>".$persoon->naam."</td><td>".$persoon->mail."</td></tr>";
    // }
}
?>
</table>
