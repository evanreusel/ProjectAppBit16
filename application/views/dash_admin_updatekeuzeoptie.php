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

    if($token != true){
        $idData=form_hidden("id", $keuzeoptie->id);
    }
    else{
        $idData=form_hidden("KeuzemogelijkheidId", $keuzemogelijkheid->id);
        $data = "";
        $keuzeoptie = new stdClass();
        $keuzeoptie->id=$data;
        $keuzeoptie->naam=$data;
        $keuzeoptie->plaatsId=$data;
        $keuzeoptie->min=$data;
        $keuzeoptie->max=$data;
        $keuzeoptie->beginTijdstip=$data;
        $keuzeoptie->eindTijdstip=$data;

    };

    foreach ($plaatsen as $plek) {
        array_push($plaats, $plek->naam);
    };

    $datumAttributen = array(
        'size'  =>'16',
        'type'  =>'text',
        'readonly',
        'class' =>'form_datetime'
    );

    $nummerAttributen = array(
        'size'  =>'10',
        'type'  =>'number'
    );
?>
    


    <?php echo form_open('keuzeoptie/update', array('name' => 'keuzeoptieFrom', 'id' => 'keuzeoptieForm', 'role' => 'form'));  ?>
    </br>
    <label for="keuzeoptie">Naam keuzeoptie:</label>
    <?php echo form_input(array('id'=>'keuzeoptie', 'name'=>'naam'),$keuzeoptie->naam); ?>
    </br>
    <label for="plaats">Plaats:</label>
    <?php echo form_dropdown("plaats", $plaats, $keuzeoptie->plaatsId) ?>
    </br>
    <label for="minimum">Minimum aantal personen</label>
    <?php echo form_input(array('id'=>'minimum', 'name'=>'min'),$keuzeoptie->min,$nummerAttributen); ?>
    </br>
    <label for="maximum">Maximum aantal personen</label>
    <?php echo form_input(array('id'=>'maximum', 'name'=>'max'),$keuzeoptie->max,$nummerAttributen); ?>
    </br>
    <label for="begin">Begin datum en tijdstip:</label>
    <?php echo form_input(array('id'=>'begin', 'name'=>'beginTijdstip', 'readonly'=>TRUE),$keuzeoptie->beginTijdstip,$datumAttributen); ?>
    </br>
    <label for="einde">Eind datum en tijdstip:</label>
    <?php echo form_input(array('id'=>'einde', 'name'=>'eindTijdstip', 'readonly'=>TRUE),$keuzeoptie->eindTijdstip,$datumAttributen); ?>
    </br>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            