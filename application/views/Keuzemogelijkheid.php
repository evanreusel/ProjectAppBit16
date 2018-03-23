<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>keuzemogelijkheden</title>
    </head>
    <body>
        <ul class="nav nav-tabs">
        <?php foreach ($activiteiten as $activiteit) {
                echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary">'. $activiteit->naam .'</a></li>';
            
        }?>
        </ul>
        <div class="tab-content">
        <?php foreach ($activiteiten as $activiteit) {
            
            

            $kollommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="primary-color">';
            
                foreach ($kollommen as $kollom) {
                    
                    echo "<th>".$kollom."</th>";
                }       
                        
           echo "</tr>";   

            foreach ($activiteit->keuzeopties as $keuzeoptie) {
                echo "<tr>";

                foreach ($kollommen as $kollom) {
                    echo '<td>' . $keuzeoptie->$kollom . '</td>';
                }

                   echo "</tr>"; 
            }

            echo "</table></div>";

        }?>
        </div>
       
        <script src="../assets/Keuzemogelijkheid.js"></script>
    </body>
</html>