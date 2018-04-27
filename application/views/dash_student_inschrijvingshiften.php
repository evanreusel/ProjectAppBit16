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
                    echo '<button class="btn btn-warning float-right" id="uitschrijven" value="'.$shift->id.'" ';
                    if (!isset($ingeschrevenshiften->$id)) {
                        echo 'hidden';
                    }
                    echo '>Uitschrijven</button>';
                    echo print_r($ingeschreven);
                    echo '<button class="btn btn-primary float-right" id="inschrijven" value="'.$shift->id.'" ';
                    if (isset($ingeschrevenshiften->$id)) {
                        echo 'hidden';
                    }echo '>Inschrijven</button>';
                    foreach($ingeschreven as $shiftId){
                        if($shiftId->shiftId == $shift->id){
                            
                        }else{

                        }
                    }
        }     
        echo "</li></ul></li>";
    };
    echo "</ul></div></div>";
};
?>
<p id="val"></p>
<p id="test"></p>
<script>
$(document).ready(function(){
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
});
</script>