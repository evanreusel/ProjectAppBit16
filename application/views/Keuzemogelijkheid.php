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
            
            

            $kolommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="primary-color">';
            
                foreach ($kolommen as $kolom) {
                    
                    echo "<th>".$kolom."</th>";
                }       
                        
           echo "<td></td><td></td></tr>";   

            foreach ($activiteit->keuzeopties as $keuzeoptie) {
                echo "<tr>";

                foreach ($kolommen as $kolom) {
                    echo '<td>' . $keuzeoptie->$kolom . '</td>';
                }

                echo '<td>'.anchor('"keuzemogelijkheid/'.$keuzeoptie->id.'"','<button class="btn btn-round btn-warning"><i class="fa fa-cog">&#xf014;</i></button>').'</td>';
                echo '<td>'.anchor('"keuzemogelijkheid/'.$keuzeoptie->id.'"','<button class="btn btn-round btn-danger"><i class="fa fa-trash-o"></i></button>').'</td>';

                   echo "</tr>"; 
            }

            echo "</table></div>";

        }?>
        </div>
       
        <script src="../assets/Keuzemogelijkheid.js"></script>
    </body>
</html>
