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
        'class' =>'form-control nummerinput'
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
        <label for="minimum" class="col-form-label">Minimum aantal personen</label>
        <?php echo form_input(array('id'=>'minimum', 'name'=>'min', 'type'=>'number'),$keuzeoptie->min,$nummerAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="maximum" class="col-form-label">Maximum aantal personen</label>
        <?php echo form_input(array('id'=>'maximum', 'name'=>'max', 'type'=>'number'),$keuzeoptie->max,$nummerAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="begin" class="col-form-label">Begin datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'begin', 'name'=>'beginTijdstip', 'readonly'=>TRUE),$keuzeoptie->beginTijdstip,$datumAttributen); ?>

    </div>
    <div class="form-group row">
        <label for="einde" class="col-form-label">Eind datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'einde', 'name'=>'eindTijdstip', 'readonly'=>TRUE),$keuzeoptie->eindTijdstip,$datumAttributen); ?>

    </div>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo anchor('admin/dash/keuzemogelijkheidbeheer/'.$keuzemogelijkheid->jaargangId,'Annuleer','class="btn btn-warning"');
        echo form_close();
    ?>

    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

        $(".nummerinput").click(function(){
            var min = $('#minimum').val();
            var max = $('#maximum').val();
            console.log("fire");

            if (min > max) {
                alert("Het minimum aantal deelnemers is groter dan het maximum.");
                $('#min').addClass('is-invalid');
                $(".bevestig").attr("disabled", true);
            }else{
                $(".bevestig").attr("disabled", false);
            };
        });

        $("#keuzeoptieForm").submit(function(event) {
            var min = $('.min').val();
            var max = $('.max').val();
            var begin =$('#begin').val()); 
            var einde =$('#einde').val());
            console.log(begin);
            console.log(einde);


            if (min > max) {
                alert("Het minimum aantal deelnemers is groter dan het maximum.");
                $('#min').addClass('is-invalid');
                event.preventDefault();
            }
            if (begin>einde) {
                alert("De begindatum vindt plaats na de einddatum.");
                $('#begin').addClass('is-invalid');
                event.preventDefault();
            }
            else {
                
            };

        });

    </script>            