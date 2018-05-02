<table>
<tr>
<th>Naam</th>
<th>e-mailadres</th>
</tr>
<?php
foreach ($shiften as $shift) {
    
    foreach ($shift->personen as $persoon) {
        echo "<tr><td>".$persoon->naam."</td><td>".$persoon->mail."</td></tr>";
    }
}
?>
</table>