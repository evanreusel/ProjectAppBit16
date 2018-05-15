<!-- 
    TIM SWERTS
    LAST UPDATED: 18 03 30
    DASH ADMIN TAKENBEHEER
-->

<ul class="nav nav-tabs buttonmenu">
<?php
if(count($taken) > 0) {
    foreach ($taken as $taak) {
        echo '<li><a href="#'.$taak->id.'" data-toggle="tab" class="btn btn-primary" title="Druk hier om de shiften voor deze taak aan te passen">'. $taak->functie .'</a></li>';
    }
}?>
    <li><?php echo anchor("admin/dash/updatetaak/".$keuzemogelijkheidId.'i',"+",'class="btn btn-primary" title = "Druk hier om een nieuwe taak aan te maken"');?></li>
    <li><?php echo anchor("admin/dash/keuzemogelijkheidbeheer/")?></li>
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
                echo '<td>'.anchor('admin/dash/updateshift/'.$shift->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om deze shift aan te passen"><i class="fa fa-cog"></i> Aanpassen</button>').'</td>';
                echo '<td><button class="deleteShift btn btn-round btn-danger" title="Druk hier om deze shift te verwijderen" data-toggle="modal" data-target="#taakModal" value="'.$shift->id.'"><i class="fa fa-trash"></i> Verwijderen</button></td>';
                   echo "</tr>";
            }

            echo "</table>";
            echo anchor('admin/dash/updateshift/'.$taak->id.'i',"Shift toevoegen",'class="btn btn-primary" title="Druk hier om een shift toe te voegen"');
            echo anchor('admin/dash/updatetaak/'.$taak->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om de Taak aan te passen"><i class="fa fa-cog"></i> ' .$taak->functie. ' aanpassen</button>').'</td>';
            echo '<button class="deleteTaak btn btn-round btn-danger" title="Druk hier om deze taak te verwijderen" data-toggle="modal" data-target="#taakModal" value="'.$taak->id.'"><i class="fa fa-trash"></i> '. $taak->functie . ' Verwijderen</button></div>';

        }
    }
    else{
        echo 'No data';   
    }?>
</div>
<div class="modal fade" id="taakModal" tabindex="-1" role="dialog" aria-labelledby="modaltitel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitel">Shift verwijderen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modaltekst">Weet u zeker dat u deze shift wil verwijderen?</p>
      </div>
      <div class="modal-footer">
        <a id="verwijderenShift" class="btn btn-danger btn-round">Verwijderen</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuleer</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.deleteShift').click(function(){
            $('#modaltitel').text('Shift verwijderen?')
            $('#modaltekst').text('Weet u zeker dat u deze shift wil verwijderen?')

            shiftId=$(this).val();
            $('#verwijderenKeuze').attr("href", "http://projectab16.ddns.net/index.php/shiften/delete/"+keuzeoptieId);
        });
        $('.deleteTaak').click(function(){
            $('#modaltitel').text('Taak verwijderen?')
            $('#modaltekst').text('Weet u zeker dat u deze taak wil verwijderen?')
            
            taakId=$(this).val();
            $('#verwijderenKeuze').attr("href", "http://projectab16.ddns.net/index.php/taken/delete/"+keuzemogelijkheidId);
        });

    });
</script>