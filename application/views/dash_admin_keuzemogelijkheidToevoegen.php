<?php
/* 
TIM SWERTS
LAST UPDATED: 18 03 30
DASH ADMIN KEUZEMOGELIJKHEID ADD/UPDATE
*/

    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    
    $jaren = array('');
    $toevoegen = array('');
    $plaats = array('');

    foreach ($plaatsen as $plek) {
        array_push($plaats, $plek->naam);
    }
?>
    


    <?php echo form_open('keuzemogelijkheid/update', array('name' => 'keuzemogelijkheidFrom', 'id' => 'keuzemogelijkheidForm', 'role' => 'form'));  ?>
    
    <h2>Keuzemogelijkheid toevoegen voor jaar <?php echo $jaargang->naam; ?>:</h2>
    </br>
    <label for="keuzemogelijkheid">Naam keuzemogelijkheid:</label>
    <input id="keuzemogelijkheid" name="naam" type="text" value="">
    </br>
    <label for="plaats">Plaats:</label>
    <?php echo form_dropdown("plaats", $plaats) ?>
    </br>
    <label for="begin">Begin datum en tijdstip:</label>
    <input id="begin" name="beginTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    </br>
    <label for="einde">Eind datum en tijdstip:</label>
    <input id="einde" name="eindTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    </br>
    <label for="deadline">Datum en tijdstip voor deadline:</label>
    <input id="deadline" name="deadlineTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    </br>
    <?php    
        echo form_hidden('jaar', $jaargang->id);
        echo form_button($arrayparameters);
        echo form_close();
    ?>

    <?php echo anchor('admin/dash/keuzemogelijkheidbeheer/'.$jaargang->id,'Annuleer','class="btn btn-primary"');?>

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            