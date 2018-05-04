<!-- 
    TIM SWERTS
    LAST UPDATED: 18 03 30
    DASH ADMIN TAKENBeHEER
-->

<ul class="nav nav-tabs">
<?php
if(count($taken) > 0) {
    foreach ($taken as $taak) {
        echo '<li><a href="#'.$taak->id.'" data-toggle="tab" class="btn btn-primary" title="Druk hier om de shiften voor deze taak aan te passen">'. $taak->functie .'</a></li>';
    }
}?>
    <li><?php echo anchor("admin/dash/taaktoevoegen/".$keuzemogelijkheidId,"+",'class="btn btn-primary" title = "Druk hier om een nieuwe taak aan te maken"');?></li>
</ul>

<div class="tab-content">
    <?php
        if(count($taken) > 0) {
            foreach ($taken as $taak) {
            $kolommen= array("functie", "beschrijving");
            echo '<div id="'. $taak->id .'" class="tab-pane fade"><table class="table"><tr class="colored">';
            
                foreach ($kolommen as $kolom) {
                    
                    echo "<th>".$kolom."</th>";
                }       
                        
           echo "<td></td><td></td></tr>";   

            foreach ($taak->shiften as $shift) {
                echo "<tr>";

                foreach ($kolommen as $kolom) {
                    echo '<td>' . $shift->$kolom . '</td>';
                }

                echo '<td>'.anchor('admin/dash/updatekeuzeoptie/'.$shift->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om deze keuzeoptie aan te passen"><i class="fa fa-cog"></i> Aanpassen</button>').'</td>';
                echo '<td>'.anchor('keuzeoptie/delete/'.$shift->id,'<button class="btn btn-round btn-danger" title="Druk hier om deze keuzeoptie te verwijderen"><i class="fa fa-trash"></i> Verwijderen</button>').'</td>';

                   echo "</tr>"; 
            }

            echo "</table>";
            echo anchor('admin/dash/updatekeuzeoptie/'.$taak->id.'i',"Keuzeoptie toevoegen",'class="btn btn-primary" title="Druk hier om een keuzeoptie toe te voegen"');
            echo anchor('admin/dash/takenbeheer/'.$taak->id,'<button class="btn btn-round btn-warning" title="Druk hier om taken te beheren bij deze keuzemogelijkheid"><i class="fa fa-cog"></i>' .$activiteit->naam. ' vrijwilliger taken</button>').'</td>';
            echo anchor('admin/dash/updatekeuzemogelijkheid/'.$taak->id,'<button class="btn btn-round btn-warning" title="Druk hier om de keuzemogelijkheid aan te passen"><i class="fa fa-cog"></i>' .$activiteit->naam. ' aanpassen</button>').'</td>';
            echo anchor('Keuzemogelijkheid/delete/' . $taak->id, '<button type="button" class="btn btn-danger btn-round" title="Druk hier om de keuzemogelijkheid te verwijderen"><i class="fa fa-trash"></i>'. $activiteit->naam . 'Verwijderen</button></div>');

        }
    }
    else{
        echo 'No data';   
    }?>
</div>