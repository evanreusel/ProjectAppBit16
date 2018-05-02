<?php 
$ingeschrevenshiften = new stdClass();
foreach ($ingeschreven as $key) {
    $id=$key->shiftId;
    $ingeschrevenshiften->$id=0; 
}

foreach($keuzemogelijkheden as $activiteit) {
    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$activiteit->naam.'</div><div class="card-body"><ul class="list-group">';
    foreach ($activiteit->taken as $taak) {
        echo '<li class="list-group-item justify-content-between align-items-center"><p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
                    $id = $shift->id;
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam;
                    echo '<button class="btn btn-warning float-right ';
                    if (!isset($ingeschrevenshiften->$id)) {
                        echo 'hidden';
                    }
                    echo '" id="uitschrijven" value="'.$shift->id.'" title="uitschrijven voor deze taak">Uitschrijven</button>';
                    echo '<button class="btn btn-primary float-right ';
                    if (isset($ingeschrevenshiften->$id)) {
                        echo 'hidden';
                    }echo '" id="inschrijven" value="'.$shift->id.'" title="inschrijven voor deze taak">Inschrijven</button>';
                    echo '<button id="vrijwilligers" class"btn btn-primary float-right" value="'.$shift->id.'" data-toggle="modal" data-target="#dialoogvrijwilligers" title="vrijwilligers weergeven die deelnemen">Vrijwilligers</button>';
        }     
        echo "</li></ul></li>";
    };
    echo "</ul></div></div>";
};
?>
<div class="modal fade" id="dialoogvrijwilligers" tabindex="-1" role="dialog" aria-labelledby="dialoogVrijwilligersLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dialoogVrijwilligersLabel">Shift title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="dialoogvenster"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<p id="val"></p>
<p id="test"></p>
<script>
$(document).ready(function(){
    $('.hidden').each(function(){
        $(this).hide();
    })
    $("#inschrijven").click(function(){
        var shiftId = $(this).val();
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftToevoegen/'+ shiftId +'/' + <?= $user->id; ?>,
                type: "GET",
                async: false,
                success: function(data){                    
                        $('#inschrijven').hide();
                        $('#uitschrijven').show();
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });

    $("#uitschrijven").click(function(){
        var shiftId = $(this).val();
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftVerwijderen/'+ shiftId +'/' + <?= $user->id; ?>,
                type: "GET",
                async: false,
                success: function(data){                    
                        $('#uitschrijven').hide();
                        $('#inschrijven').show();
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });

    $("#vrijwilligers").click(function(){
        var shiftId = $(this).val();
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftWeergeven/'+ shiftId ,
                type: "GET",
                async: false,
                success: function(data){                    
                        $('#dialoogvenster').text(data);
                        $('#val').text(data);
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });
});
</script>