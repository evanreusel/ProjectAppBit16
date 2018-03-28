<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['content'] = "Bevestig";

    $options = array(
        'small'         => 'Small Shirt',
        'med'           => 'Medium Shirt',
        'large'         => 'Large Shirt',
        'xlarge'        => 'Extra Large Shirt',
        );
    
    // if(isset($data['admin'])){
    //     $arrayparameters['content'] = "Pas admin aan";
    // } else {
    //     $arrayparameters['content'] = "Maak nieuwe admin aan";
    // }
?>
    


    <?php echo form_open('keuzemogelijkheid/update', array('name' => 'keuzemogelijkheidFrom', 'id' => 'keuzemogelijkheidForm', 'role' => 'form'));  ?>
    
    <label for="jaar">Plaats:</label>
    <?php echo form_dropdown("jaar", $options) ?>
    
    <label for="keuzemogelijkheid">Naam keuzemogelijkheid:</label>
    <input id="keuzemogelijkheid" name="naam" type="text" value="">

    <label for="plaats">Plaats:</label>
    <?php echo form_dropdown("plaats", $options) ?>

    <label for="begin">Begin datum en tijdstip:</label>
    <input id="begin" name="beginTijdstip" size="16" type="text" value="" readonly class="form_datetime">

    <label for="einde">Eind datum en tijdstip:</label>
    <input id="einde" name="eindTijdstip" size="16" type="text" value="" readonly class="form_datetime">

    <label for="deadline">Datum en tijdstip voor deadline:</label>
    <input id="deadline" name="deadlineTijdstip" size="16" type="text" value="" readonly class="form_datetime">

    <?php    
        echo form_button($arrayparameters);
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            