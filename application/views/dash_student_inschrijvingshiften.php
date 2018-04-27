<?php foreach($keuzemogelijkheden as $activiteit) {

    echo '<div class="shiften card"><div class="card-header bg-primary text-white">'.$activiteit->naam.'</div><div class="card-body"><ul class="list-group">';
    foreach ($activiteit->taken as $taak) {
        echo '<li class="list-group-item justify-content-between align-items-center"><p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
            echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam;
            echo '<button class="btn btn-success float-right inschrijven" value="'.$shift->id.'">Inschrijven</button>';
        }
        echo "</li></ul></li>";
    };
    echo "</ul></div></div>";
};
echo $user->id;
?>

<p id="test"></p>
<script>
$(document).ready(function(){
    $(".btn").click(function(){
        $.ajax({
                url: '<?= site_url(); ?>/shiften/vrijwilligerInShiftToevoegen',
                type: "GET",
                success: function(data){                    
                        $('#test').text(data);
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
    });
});
</script>