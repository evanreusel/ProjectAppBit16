<ul class="nav nav-tabs">
<?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
    echo '<li><a href="#'.$activiteit->id.'" data-toggle="tab" class="btn btn-primary">'. $activiteit->naam .'</a></li>';
}?>
    <li><?php echo anchor("admin/dash/updatekeuzemogelijkheid","+",'class="btn btn-primary"');?></li>
</ul>

<div class="tab-content">
    <?php foreach ($data['keuzemogelijkheden'] as $activiteit) {
            $kolommen= array("naam", "plaatsId", "min", "max", "beginTijdstip","eindTijdstip");
<<<<<<< HEAD
          echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="primary-color">';
=======
            echo '<div id="'. $activiteit->id .'" class="tab-pane fade"><table class="table"><tr class="colored">';
>>>>>>> e43ed63cd0d1457c48e70621093df9e3b422340f
            
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

            echo "</table>";
            echo '<a href="" class="btn btn-primary">Keuzeoptie toevoegen</a>';
            echo '<a href="" class="btn btn-primary">'.$activiteit->naam.' aanpassen</a>';
            echo '<a href="" class="btn btn-primary">'.$activiteit->naam.' verwijderen</a></div>';

        }?>
</div>

<script src="../assets/Keuzemogelijkheid.js"></script>