<!-- 
    TIM SWERTS
    LAST UPDATED: 18 05 14
    DASH ADMIN KEUZEMOGELIJKHEIDBEHEER
-->

<ul class="nav nav-tabs buttonmenu">
<?php
/// Vormen van alle tab-knoppen van alle keuzemogelijkheden
if(count($data['keuzemogelijkheden']) > 0) {
    foreach ($data['keuzemogelijkheden'] as $activiteit) {
        echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary" title="Druk hier om de keuzeopties voor deze keuzemogelijkheid aan te passen">'. $activiteit->naam .'</a></li>';
    }
}?>
    <li><?php echo anchor("admin/dash/keuzemogelijkheidToevoegen/".$jaargang->id,"+",'class="btn btn-primary" title = "Druk hier om een nieuwe keuzemogelijkheid aan te maken"');?></li>
    <?php echo anchor("admin/dash/jaargangbeheer/".$jaargang->id,"Ga terug",'class="btn btn-secondary right" title = "Druk hier om terug te gaan naar het jaargang overzicht."' )?>
</ul>
<div class="tab-content">
    <?php
        /// Invullen van de tabel met alle gevonden resultaten.
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

                echo '<td>'.anchor('admin/dash/updatekeuzeoptie/'.$keuzeoptie->id.'u','<button class="btn btn-round btn-warning" title="Druk hier om deze keuzeoptie aan te passen"><i class="fa fa-cog"></i> Aanpassen</button>').'</td>';
                echo '<td><button class="deleteKeuzeoptie btn btn-round btn-danger" title="Druk hier om deze keuzeoptie te verwijderen" data-toggle="modal" data-target="#keuzeModal" value="'.$keuzeoptie->id.'"><i class="fa fa-trash"></i> Verwijderen</button></td>';
                   echo "</tr>"; 
            }
            /// Aanmaak van de knoppen om het beheer van de keuzemogelijkheden en keuzeopties mogelijk te maken
            echo "</table>";
            echo anchor('admin/dash/updatekeuzeoptie/'.$activiteit->id.'i',"Keuzeoptie toevoegen",'class="btn btn-primary" title="Druk hier om een keuzeoptie toe te voegen"');
            echo anchor('admin/dash/takenbeheer/'.$activiteit->id,'<button class="btn btn-round btn-warning" title="Druk hier om taken te beheren bij deze keuzemogelijkheid"><i class="fa fa-cog"></i> ' .$activiteit->naam. ' vrijwilliger taken</button>').'</td>';
            echo anchor('admin/dash/updatekeuzemogelijkheid/'.$activiteit->id,'<button class="btn btn-round btn-warning" title="Druk hier om de keuzemogelijkheid aan te passen"><i class="fa fa-cog"></i> ' .$activiteit->naam. ' aanpassen</button>').'</td>';
            echo '<button class="deleteKeuzemogelijkheid btn btn-round btn-danger" title="Druk hier om deze keuzemogelijkheid te verwijderen" data-toggle="modal" data-target="#keuzeModal" value="'.$activiteit->id.'"><i class="fa fa-trash"></i> '. $activiteit->naam . ' Verwijderen</button></div>';
        }
    }
    else{
        echo 'Er is geen data beschikbaar maak nieuwe keuzemogelijkheden aan door op de plus-knop te klikken';   
    }?>
</div>
<!-- Popup die aanpast aan het item dat verwijderd zal worden -->
<div class="modal fade" id="keuzeModal" tabindex="-1" role="dialog" aria-labelledby="modaltitel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitel">Keuzeoptie verwijderen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modaltekst">Weet u zeker dat u deze keuzeoptie wil verwijderen?</p>
      </div>
      <div class="modal-footer">
        <a id="verwijderenKeuze" class="btn btn-danger btn-round">Verwijderen</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuleer</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.deleteKeuzeoptie').click(function(){
            $('#modaltitel').text('Keuzeoptie verwijderen?')
            $('#modaltekst').text('Weet u zeker dat u deze keuzeoptie wil verwijderen?')

            keuzeoptieId=$(this).val();
            $('#verwijderenKeuze').attr("href", "<?php echo base_url() ?>index.php/keuzeoptie/delete/"+keuzeoptieId);
        });
        $('.deleteKeuzemogelijkheid').click(function(){
            $('#modaltitel').text('Keuzemogelijkheid verwijderen?')
            $('#modaltekst').text('Weet u zeker dat u deze keuzemogelijkheid wil verwijderen?')
            
            keuzemogelijkheidId=$(this).val();
            $('#verwijderenKeuze').attr("href", "<?php echo base_url() ?>index.php/keuzemogelijkheid/delete/"+keuzemogelijkheidId);
        });

    });
</script>