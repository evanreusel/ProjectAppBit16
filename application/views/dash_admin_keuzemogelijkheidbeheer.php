<ul class="nav nav-tabs">
<?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
    echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary">'. $activiteit->naam .'</a></li>';
}?>
    <li><a href="http://projectab16.ddns.net/index.php/admin/dash/updateKeuzemogelijkheid" class="btn btn-primary">+</a></li>
    <?php echo anchor("admin/dash/updateKeuzemogelijkheid","+", class => "btn btn-primary");?>
</ul>

<div class="tab-content">
    <?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
            $kolommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="colored">';
            
                foreach ($kolommen as $kolom) {
                    
                    echo "<th>".$kolom."</th>";
                }       
                        
           echo "</tr>";   

            foreach ($activiteit->keuzeopties as $keuzeoptie) {
                echo "<tr>";

                foreach ($kolommen as $kolom) {
                    echo '<td>' . $keuzeoptie->$kolom . '</td>';
                }

                   echo "</tr>"; 
            }

            echo "</table>";
            echo '<a href="" class="btn btn-primary">Keuzeoptie toevoegen</a>';
            echo '<a href="" class="btn btn-primary">'.$activiteit->naam.' aanpassen</a>';
            echo '<a href="" class="btn btn-primary">'.$activiteit->naam.' verwijderen</a></div>';

        }?>
</div>

<script src="../assets/Keuzemogelijkheid.js"></script>