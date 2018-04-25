<?php foreach($keuzemogelijkheden as $activiteit) {

    echo "<h2>".$activiteit->naam."</h2><ul>";
    foreach ($activiteit->taken as $taak) {
        echo "<p>".$taak->functie."</p><ul>";
        foreach ($taak->shiften as $shift ) {
            echo "<li>".$shift->naam."</li>";
        }
        echo "</ul></li>";
    };
    echo "</ul>";
};
?>