<ul class="nav nav-tabs">
<?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
    echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary">'. $activiteit->naam .'</a></li>';
}?>
</ul>

<div class="tab-content">
    <?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
            $kollommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="colored">';
            
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