
<table>
<tr>
<th>Naam</th>
<th>e-mailadres</th>
</tr>
<?php
foreach ($shiften as $shift) {
    
        echo "<tr><td>".$shift->persoon->naam."</td><td>".$shift->persoon->mail."</td></tr>";
    
}
?>
</table>
