<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <title>keuzemogelijkheden</title>
    </head>
    <body>
        
        <?php foreach ($activiteiten as $activiteit) {
            
            echo anchor("#",$activiteit->naam,array('class' => 'btn btn-primary'));

            $kollommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo "<table><tr>";
            
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

            echo "</table>";

        }?>
        
    </body>
</html>
