
<table class="table">
<thead class="thead-light">
<tr>
<th>Naam</th>
<th>e-mailadres</th>
</tr>
</thead>
<tbody>
<?php
foreach ($shiften as $shift) {
    
        echo "<tr><td>".$shift->persoon->naam."</td><td>".$shift->persoon->mail."</td></tr>";
    
}
?>
</tbody>
</table>
