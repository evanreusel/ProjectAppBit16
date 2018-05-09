<?php 
$ingeschrevenActiviteiten = new stdClass();
foreach ($ingeschreven as $key) {
    $id=$key->keuzeoptieId;
    $ingeschrevenActiviteiten->$id=0; 
}

//print_r($keuzemogelijkheden);
//echo '</br></br>';
print_r($ingeschreven);
foreach($keuzemogelijkheden as $keuzemogelijkheid) {
    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$keuzemogelijkheid->naam.'</div><div class="card-body"><ul class="list-group">';

        foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie ) {
                    $id = $keuzeoptie->id;
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$keuzeoptie->naam;
                    /*echo '<button class="btn btn-warning float-right ';
                    if (!isset($ingeschrevenActiviteiten->$id)) {
                        echo 'hidden';
                    }
                    echo '" id="uitschrijven" value="'.$keuzeoptie->id.'" title="uitschrijven voor deze taak">Uitschrijven</button>';
                    echo '<button class="btn btn-primary float-right ';
                    if (isset($ingeschrevenActiviteiten->$id)) {
                        echo 'hidden';
                    }echo '" id="inschrijven" value="'.$keuzeoptie->id.'" title="inschrijven voor deze taak">Inschrijven</button>';
                    */

                    echo '<button class="btn keuzeoptie float-right ';
                    if (!isset($ingeschrevenActiviteiten->$id)) {
                        echo 'btn-primary" title="inschrijven voor deze taak';
                    } else {
                        echo 'btn-warning title="uitschrijven voor deze taak';
                    }echo '" id="'. $keuzeoptie->id .'" value="'.$keuzeoptie->id.'">';

                    if (!isset($ingeschrevenActiviteiten->$id)) {
                        echo 'inschrijven';
                    } else {
                        echo 'uitschrijven';
                    }
                    
                    echo '</button>';
                    
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
    $(".keuzeoptie").click(function(){        
        var keuzemogelijkheidId = $(this).val();
        if($(this).hasClass('btn-primary')){
        $.ajax({
                url: '<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                
                    console.log('3');    
                        console.log('<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>);
                        $('#'+keuzemogelijkheidId).removeClass('btn-primary');
                        $('#'+keuzemogelijkheidId).addClass('btn-warning');
                        console.log('1');
                        $('#'+keuzemogelijkheidId).text('uitschrijven');
                        console.log('2');
                }, error: function (xhr, status, error) {
                    console.log('<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>);
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    } else {
        $.ajax({
                url: '<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerVanKeuzeoptieVerwijderen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        $('#'+keuzemogelijkheidId).removeClass('btn-warning');
                        $('#'+keuzemogelijkheidId).addClass('btn-primary');
                        $('#'+keuzemogelijkheidId).text('inschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    }
});   
});
</script>