<?php foreach($keuzemogelijkheden as $activiteit) {

    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$activiteit->naam.'</div><div class="card-body"><ul class="list-group">';
    foreach ($activiteit->taken as $taak) {
        echo '<li class="list-group-item justify-content-between align-items-center"><p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
            foreach ($ingeschreven as $inschrijving) {
                if ($inschrijving->shiftId == $shift->id) {
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam;
                    echo '<button class="btn btn-warning float-right inschrijven" id="'.$shift->id.'">Uitschrijven</button>';
                }else {
                    echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam;
                    echo '<button class="btn btn-primary float-right inschrijven" id="'.$shift->id.'">Inschrijven</button>';
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
    $(".btn-primary").click(function(){
        var shiftId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftToevoegen/'+ shiftId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        // $('#'+shiftId).removeClass('btn-primary');
                        // $('#'+shiftId).addClass('btn-warning');
                        // $('#'+shiftId).text('uitschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });

    $(".btn-warning").click(function(){
        var shiftId = $(this).attr('id');
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftVerwijderen/'+ shiftId +'/' + <?= $user->id; ?>,
                type: "GET",
                success: function(data){                    
                        // $('#'+shiftId).removeClass('btn-warning');
                        // $('#'+shiftId).addClass('btn-primary');
                        // $('#'+shiftId).text('inschrijven');
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });
});
</script>