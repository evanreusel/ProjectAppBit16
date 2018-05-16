<!-- 
    TIM SWERTS
    LAST UPDATED: 23 04 2018
    DASH ADMIN KEUZEMOGELIJKHEID ADD/UPDATE
-->

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    $arrayparameters['class'] = "btn btn-primary bevestig";
    

    $plaats = array('');

    if($token != true){
        $idData=form_hidden("id", $keuzeoptie->id).form_hidden("keuzemogelijkheidId", $keuzeoptie->keuzemogelijkheidId);
        $taak="";
    }
    else{
        $idData=form_hidden("keuzemogelijkheidId", $keuzemogelijkheid->id);
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
        'class' =>'form_datetime form-control'
    );

    $nummerAttributen = array(
        'size'  =>'10',
        'type'  =>'number',
        'class' =>'form-control'
    );
?>
    


    <?php echo form_open('keuzeoptie/update', array('name' => 'keuzeoptieFrom', 'id' => 'keuzeoptieForm', 'role' => 'form'));  ?>

    <div class="form-group row">
        <label for="keuzeoptie">Naam keuzeoptie:</label>
        <?php echo form_input(array('id'=>'keuzeoptie', 'name'=>'naam', 'class'=>'form-control'),$keuzeoptie->naam); ?>

    </div>
    <div class="form-group row">
        <label for="plaats" class="col-form-label">Plaats:</label>
        <?php echo form_dropdown("plaatsId", $plaats, $keuzeoptie->plaatsId, array('class'=>'form-control')) ?>
    </div>
    <div class="form-group row">
        <label for="minimum">Minimum aantal personen</label>
        <?php echo form_input(array('id'=>'minimum', 'name'=>'min', 'type'=>'number', 'class'=>'min'),$keuzeoptie->min,$nummerAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="maximum">Maximum aantal personen</label>
        <?php echo form_input(array('id'=>'maximum', 'name'=>'max', 'type'=>'number', 'class'=>'max'),$keuzeoptie->max,$nummerAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="begin">Begin datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'begin', 'name'=>'beginTijdstip', 'readonly'=>TRUE, 'class'=>'begin'),$keuzeoptie->beginTijdstip,$datumAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="einde">Eind datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'einde', 'name'=>'eindTijdstip', 'readonly'=>TRUE, 'class'=>'einde'),$keuzeoptie->eindTijdstip,$datumAttributen); ?>

    </div>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo anchor('admin/dash/keuzemogelijkheidbeheer/'.$keuzemogelijkheid->jaargangId,'Annuleer','class="btn btn-warning"');
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

        $("form").submit(function() {
            var min = $('.min').val();
            var max = $('.max').val();
            var begin =$('.begin').val(); 
            var einde =$('.einde').val();

            if (min > max) {
                $("body").alert("Het minimum aantal deelnemers is groter dan het maximum.");
                event.preventDefault();
            } else {
                
            };

        });

    </script>            