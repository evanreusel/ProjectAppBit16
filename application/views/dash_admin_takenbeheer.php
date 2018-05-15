<!-- 
    TIM SWERTS
    LAST UPDATED: 18 03 30
    DASH ADMIN TAKENBeHEER
-->

<ul class="nav nav-tabs buttonmenu">
<?php
if(count($taken) > 0) {
    foreach ($taken as $taak) {
        echo '<li><a href="#'.$taak->id.'" data-toggle="tab" class="btn btn-primary" title="Druk hier om de shiften voor deze taak aan te passen">'. $taak->functie .'</a></li>';
    }
}?>
    <li><?php echo anchor("admin/dash/updatetaak/".$keuzemogelijkheidId.'i',"+",'class="btn btn-primary" title = "Druk hier om een nieuwe taak aan te maken"');?></li>
</ul>

<div class="tab-content">
    <?php
        if(count($taken) > 0) {
            foreach ($taken as $taak) {
            echo '<div id="'. $taak->id .'" class="tab-pane fade">';
            echo '<br><h3>Beschrijving van de Taak:</h3>';
            echo '<p>'. $taak->beschrijving .'</p>';
            echo '<table class="table"><tr class="colored">';       
            echo "<th>Shift</th>";               
            echo "<td></td><td></td></tr>";   

            foreach ($taak->shiften as $shift) {
                echo "<tr>";
                echo '<td>' . $shift->naam . '</td>';
                echo '<td>'.anchor('admin/dash/updatekeuzeoptie/'.$shift->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om deze keuzeoptie aan te passen"><i class="fa fa-cog"></i> Aanpassen</button>').'</td>';
                echo '<td>'.anchor('keuzeoptie/delete/'.$shift->id,'<button class="btn btn-round btn-danger" title="Druk hier om deze keuzeoptie te verwijderen"><i class="fa fa-trash"></i> Verwijderen</button>').'</td>';

                   echo "</tr>"; 
            }

            echo "</table>";
            echo anchor('admin/dash/update/'.$taak->id.'i',"Shift toevoegen",'class="btn btn-primary" title="Druk hier om een shift toe te voegen"');
            echo anchor('admin/dash/updatetaak/'.$taak->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om de Taak aan te passen"><i class="fa fa-cog"></i> ' .$taak->functie. ' aanpassen</button>').'</td>';
            echo anchor('taken/delete/' . $taak->id, '<button type="button" class="btn btn-danger btn-round" title="Druk hier om de Taak te verwijderen"><i class="fa fa-trash"></i> '. $taak->functie . ' verwijderen</button></div>');

        }
    }
    else{
        echo 'No data';   
    }?>
</div>