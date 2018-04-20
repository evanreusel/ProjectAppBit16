<!-- 
    TIM SWERTS
    LAST UPDATED: 18 03 30
    DASH ADMIN KEUZEMOGELIJKHEID ADD/UPDATE
-->

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    

    $plaats = array('');

    if($jaargang != null){
        $idData=form_hidden("KeuzemogelijkheidID", $jaargang);
    }
    else{
        $idData=form_hidden("KeuzemogelijkheidID", $KeuzemogelijkheidId);
    }

    foreach ($plaatsen as $plek) {
        array_push($plaats, $plek->naam);
    }
?>
    


    <?php echo form_open('keuzeoptie/update', array('name' => 'keuzeoptieFrom', 'id' => 'keuzeoptieForm', 'role' => 'form'));  ?>
    <?php echo $idData?>
    </br>
    <label for="keuzeoptie">Naam keuzeoptie:</label>
    <input id="keuzeoptie" name="naam" type="text" value="">
    </br>
    <label for="plaats">Plaats:</label>
    <?php echo form_dropdown("plaats", $plaats) ?>
    </br>
    <label for="minimum">Minimum aantal personen</label>
    <input id="minimum" name="min" size="10" type="number">
    </br>
    <label for="maximum">Maximum aantal personen</label>
    <input id="maximum" name="max" size="10" type="number">
    </br>
    <label for="begin">Begin datum en tijdstip:</label>
    <input id="begin" name="beginTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    </br>
    <label for="einde">Eind datum en tijdstip:</label>
    <input id="einde" name="eindTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    </br>
    <?php    
        echo form_button($arrayparameters);
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            