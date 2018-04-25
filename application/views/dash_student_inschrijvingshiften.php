<?php foreach($keuzemogelijkheden as $activiteit) {

    echo '<div class="shiften"><h2>'.$activiteit->naam.'</h2><ul class="list-group">';
    foreach ($activiteit->taken as $taak) {
        echo '<li class="list-group-item justify-content-between align-items-center list-group-item-primary"><p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
            echo '<li class="list-group-item justify-content-between align-items-center">'.$shift->naam.'</li>';
        }
        echo "</ul></li>";
    };
    echo "</ul></div>";
};
?>