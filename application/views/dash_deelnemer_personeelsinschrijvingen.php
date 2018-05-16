<!-- 
    PROOST DAAN
	LAST UPDATED: 16 05 18
	VIEW DEELNEMERS INSCHRIJVEN
-->

<?php 

// Nagaan of deelnemer reeds ingeschreven is
$ingeschrevenActiviteiten = new stdClass();
foreach ($ingeschreven as $key) {
    $id=$key->keuzeoptieId;
    $ingeschrevenActiviteiten->$id=0; 
}

// Keuzemogelijkheden oplijsten (zoals eten, activiteiten,...) met daarin de keuzeopties (vis/vlees, tennis,...)
foreach($keuzemogelijkheden as $keuzemogelijkheid) {
    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$keuzemogelijkheid->naam.'</div><div class="card-body"><ul class="list-group">';

        foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie ) {
                    $id = $keuzeoptie->id;
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$keuzeoptie->naam;
                    echo '<button class="btn keuzeoptie float-right ';

                    // btn-primary met tekst 'inschrijven' als er nog niet is ingeschreven, anders btn-warning met tekst 'uitschrijven'
                    if (!isset($ingeschrevenActiviteiten->$id)) {
                        echo 'btn-primary" title="inschrijven voor deze taak';
                    } else {
                        echo 'btn-warning title="uitschrijven voor deze taak';
                    }echo '" id="'. $keuzeoptie->id .'" value="'.$keuzeoptie->id.'">';

                    // Tekst van de knop aanpassen nadat erop wordt geklikt (als op 'inschrijven' wordt geklikt, verandert dit in 'uitschrijven')
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
<!-- <p id="val"></p>
<p id="test"></p> -->


<!--
    Script dat zorgt voor de click-functie op de verschillende keuzeopties
    Met dit script wordt de keuze aan de database toegevoegd
 -->
<script>
$(document).ready(function(){
    $(".keuzeoptie").click(function(){        
        var keuzemogelijkheidId = $(this).val();
        // Als er nog niet ingeschreven werd
        if($(this).hasClass('btn-primary')){
        $.ajax({
                url: '<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                async: false,
                success: function(data){                   
                        console.log('<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>);
                        $('#'+keuzemogelijkheidId).removeClass('btn-primary');
                        $('#'+keuzemogelijkheidId).addClass('btn-warning');
                        $('#'+keuzemogelijkheidId).text('uitschrijven');
                }, error: function (xhr, status, error) {
                    console.log('<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerAanKeuzeoptieToevoegen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>);
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
            // Als er al wel ingeschreven werd
    } else {
        $.ajax({
                url: '<?= site_url(); ?>/KeuzeoptieVanDeelnemer/deelnemerVanKeuzeoptieVerwijderen/'+ keuzemogelijkheidId +'/' + <?= $user->id; ?>,
                type: "GET",
                async: false,
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