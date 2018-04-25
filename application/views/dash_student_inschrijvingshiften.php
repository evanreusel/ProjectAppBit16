<?php foreach($keuzemogelijkheden as $activiteit) {

    echo '<div class="shiften"><div class="panel-heading">'.$activiteit->naam.'</div><div class="panel-body"><ul class="list-group">';
    foreach ($activiteit->taken as $taak) {
        echo '<li class="list-group-item justify-content-between align-items-center"><p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
            echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam;
            echo '<button class="btn btn-success float-right inschrijven" value="'.$shift->id.'">Inschrijven</button>';
        }
        echo "</ul></li>";
    };
    echo "</ul></li></div></div>";
};
?>