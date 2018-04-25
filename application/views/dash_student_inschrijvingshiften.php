<?php foreach($keuzemogelijkheden as $activiteit) {

    echo "<h2>".$activiteit->naam."</h2>";
    foreach ($activiteit->taken as $taak) {
        echo "<h3>".$taak->functie."</h3>";
        foreach ($taak->shiften as $shift ) {
            echo "<p>".$shift->naam."</p>";
        }
    };

};
?>