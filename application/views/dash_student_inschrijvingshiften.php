<?php foreach($keuzemogelijkheden as $activiteit) {

    echo '<div class="shiften"><h2>'.$activiteit->naam."</h2><ul>";
    foreach ($activiteit->taken as $taak) {
        echo '<p><b>'.$taak->functie.':</b></p><ul class="list-group">';
        foreach ($taak->shiften as $shift ) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">'.$shift->naam.'</li>';
        }
        echo "</ul></li>";
    };
    echo "</ul></div>";
};
?>