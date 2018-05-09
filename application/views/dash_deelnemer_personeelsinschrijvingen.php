<?php 
$ingeschrevenActiviteiten = new stdClass();
foreach ($ingeschreven as $key) {
    $id=$key->keuzeoptieId;
    $ingeschrevenActiviteiten->$id=0; 
}

print_r($keuzemogelijkheden);
echo '</br></br>';
print_r($ingeschreven);
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
        var keuzemogelijkheidId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/keuzeoptievandeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        $('#'+keuzemogelijkheidId).removeClass('btn-primary');
                        $('#'+keuzemogelijkheidId).addClass('btn-warning');
                        $('#'+keuzemogelijkheidId).text('uitschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });

    $(".btn-warning").click(function(){
        var keuzemogelijkheidId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/keuzeoptievandeelnemer/deelnemerVanKeuzeoptieVerwijderen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        $('#'+keuzemogelijkheidId).removeClass('btn-warning');
                        $('#'+keuzemogelijkheidId).addClass('btn-primary');
                        $('#'+keuzemogelijkheidId).text('inschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });
});


$('.hidden').each(function({
    $(this).hide();
}));
</script>