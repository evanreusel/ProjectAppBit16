<!-- 
    TIM SWERTS
    LAST UPDATED: 18 03 30
    DASH ADMIN KEUZEMOGELIJKHEIDBEHEER
-->

<ul class="nav nav-tabs">
<?php
if(count($data['keuzemogelijkheden']) > 0) {
    foreach ($data['keuzemogelijkheden'] as $activiteit) {
        echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary">'. $activiteit->naam .'</a></li>';
    }
}?>
    <li><?php echo anchor("admin/dash/keuzemogelijkheidToevoegen/".$jaargang->id,"+",'class="btn btn-primary"');?></li>
</ul>

<div class="tab-content">
    <?php
        if(count($data['keuzemogelijkheden']) > 0) {
            foreach ($data['keuzemogelijkheden'] as $activiteit) {
            $kolommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="colored">';
            
                foreach ($kolommen as $kolom) {
                    
                    echo "<th>".$kolom."</th>";
                }       
                        
           echo "<td></td><td></td></tr>";   

            foreach ($activiteit->keuzeopties as $keuzeoptie) {
                echo "<tr>";

                foreach ($kolommen as $kolom) {
                    echo '<td>' . $keuzeoptie->$kolom . '</td>';
                }

                echo '<td>'.anchor('admin/dash/updatekeuzeoptie/'.$keuzeoptie->id.'u','<button class="btn btn-round btn-warning"><i class="fa fa-cog"></i> Aanpassen</button>').'</td>';
                echo '<td>'.anchor('keuzeoptie/delete/'.$keuzeoptie->id,'<button class="btn btn-round btn-danger"><i class="fa fa-trash"></i> Verwijderen</button>').'</td>';

                   echo "</tr>"; 
            }

            echo "</table>";
            echo anchor('admin/dash/updatekeuzeoptie/'.$activiteit->id.'i',"Keuzeoptie toevoegen",'class="btn btn-primary"');
            echo anchor('admin/dash/updatekeuzemogelijkheid/'.$activiteit->id,'<button class="btn btn-round btn-warning"><i class="fa fa-cog"></i>' .$activiteit->naam. ' aanpassen</button>').'</td>';
            echo anchor('Keuzemogelijkheid/delete/' . $activiteit->id, '<button type="button" class="btn btn-danger btn-round"><i class="fa fa-trash"></i>'. $activiteit->naam . 'Verwijderen</button></div>');

        }
    }
    else{
        echo 'No data';   
    }?>
</div>