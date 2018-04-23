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
    
    $plaats = array('');
    $datumAttributen = array(
        'size'  =>'16',
        'type'  =>'text',
        'readonly',
        'class' =>'form_datetime'
    );

    foreach ($plaatsen as $plek) {
        array_push($plaats, $plek->naam);
    }
?>
    


    <?php echo form_open('keuzemogelijkheid/update', array('name' => 'keuzemogelijkheidFrom', 'id' => 'keuzemogelijkheidForm', 'role' => 'form'));  ?>
    <h2><?php echo $keuzemogelijkheid->naam?> aanpassen:</h2>
    </br>
    <label for="keuzemogelijkheid">Naam keuzemogelijkheid:</label>
    <input id="keuzemogelijkheid" name="naam" type="text" value="<?php$keuzemogelijkheid->naam?>">
    <?php echo form_input(array('id'=>'keuzemogelijkheid', 'name'=>'naam'),$keuzemogelijkheid->naam); ?>
    </br>
    <label for="plaats">Plaats:</label>
    <?php echo form_dropdown("plaats", $plaats, $keuzemogelijkheid->plaatsId) ?>
    </br>
    <label for="begin">Begin datum en tijdstip:</label>
    <input id="begin" name="beginTijdstip" size="16" type="text" value="<?php$keuzemogelijkheid->beginTijdstip?>" readonly class="form_datetime">
    </br>
    <label for="einde">Eind datum en tijdstip:</label>
    <input id="einde" name="eindTijdstip" size="16" type="text" value="<?php$keuzemogelijkheid->eindTijdstip?>" readonly class="form_datetime">
    </br>
    <label for="deadline">Datum en tijdstip voor deadline:</label>
    <input id="deadline" name="deadlineTijdstip" size="16" type="text" value="<?php$keuzemogelijkheid->deadlineTijdstip?>" readonly class="form_datetime">
    </br>
    <?php
        echo form_hidden('jaar', $keuzemogelijkheid->jaargangId);
        echo form_hidden('id', $keuzemogelijkheid->id);
        echo form_button($arrayparameters);
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            