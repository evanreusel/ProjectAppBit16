<?php 
$ingeschrevenActiviteiten = new stdClass();
foreach ($ingeschreven as $key) {
    $id=$key->keuzeoptieId;
    $ingeschrevenActiviteiten->$id=0; 
}


// foreach($keuzemogelijkheden as $keuzemogelijkheid) {
//     echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$keuzemogelijkheid->naam.'</div><div class="card-body"><ul class="list-group">';
//     foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
        
            
//                 if ($ingeschreven[$teller]->keuzeoptieId == $keuzeoptie->id) {
//                     echo '<li class="list-group-item justify-content-between align-items-center">'.$keuzeoptie->naam;
//                     echo '<button class="btn btn-warning float-right inschrijven" id="'.$keuzeoptie->id.'">Uitschrijven</button>';
//                 }else {
//                     echo '<li class="list-group-item justify-content-between align-items-center">'.$keuzeoptie->naam;
//                     echo '<button class="btn btn-primary float-right inschrijven" id="'.$keuzeoptie->id.'">Inschrijven</button>';
//                 }
//             $teller++;
        
//         echo "</li></ul></li>";
//     };
//     echo "</ul></div></div>";
// };

foreach($keuzemogelijkheden as $keuzemogelijkheid) {
    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$keuzemogelijkheid->naam.'</div><div class="card-body"><ul class="list-group">';

        foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie ) {
                    $id = $keuzeoptie->id;
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$keuzeoptie->naam;
                    echo '<button class="btn btn-warning float-right ';
                    if (!isset($ingeschrevenActiviteiten->$id)) {
                        echo 'hidden';
                    }
                    echo '" id="uitschrijven" value="'.$keuzeoptie->id.'" title="uitschrijven voor deze taak">Uitschrijven</button>';
                    echo '<button class="btn btn-primary float-right ';
                    if (isset($ingeschrevenActiviteiten->$id)) {
                        echo 'hidden';
                    }echo '" id="inschrijven" value="'.$keuzeoptie->id.'" title="inschrijven voor deze taak">Inschrijven</button>';
                    echo '<button id="vrijwilligers" class"btn btn-primary float-right" value="'.$keuzeoptie->id.'" data-toggle="modal" data-target="#dialoogvrijwilligers" title="vrijwilligers weergeven die deelnemen">Vrijwilligers</button>';
        }     
        echo "</li></ul></li>";
    ;
    echo "</ul></div></div>";
};

?>
<p id="val"></p>
<p id="test"></p>
<script>
$(document).ready(function(){
    $(".btn-primary").click(function(){
        var shiftId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftToevoegen/'+ keuzeoptieId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        $('#'+shiftId).removeClass('btn-primary');
                        $('#'+shiftId).addClass('btn-warning');
                        $('#'+shiftId).text('uitschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });

    $(".btn-warning").click(function(){
        var shiftId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftVerwijderen/'+ keuzeoptieId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        $('#'+keuzeoptieId).removeClass('btn-warning');
                        $('#'+shkeuzeoptieId).addClass('btn-primary');
                        $('#'+keuzeoptieId).text('inschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });
});
</script>