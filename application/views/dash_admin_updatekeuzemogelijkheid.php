<?php
/* 
TIM SWERTS
LAST UPDATED: 27 04 2018 
DASH ADMIN KEUZEMOGELIJKHEID ADD/UPDATE
*/

    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    $arrayparameters['class'] = "btn btn-primary";
    
    $plaats = array('');
    $datumAttributen = array(
        'size'  =>'16',
        'type'  =>'text',
        'readonly',
        'class' =>'form_datetime form-control'
    );

    foreach ($plaatsen as $plek) {
        array_push($plaats, $plek->naam);
    }
?>
    


    <?php echo form_open('keuzemogelijkheid/update', array('name' => 'keuzemogelijkheidFrom', 'id' => 'keuzemogelijkheidForm', 'role' => 'form'));  ?>
    <h2><?php echo $keuzemogelijkheid->naam?> aanpassen:</h2>
    </br>
    <div class="form-group row">
        <label for="keuzemogelijkheid" class="col-form-label">Naam keuzemogelijkheid:</label>
        <?php echo form_input(array('id'=>'keuzemogelijkheid', 'name'=>'naam', 'title'=>'Vul hier de naam in die je aan de keuzemogelijkheid wil geven.', 'class'=>'form-control'),$keuzemogelijkheid->naam); ?>
    </div>
    <div class="form-group row">
    <label for="plaats" class="col-form-label">Plaats:</label>
    <?php echo form_dropdown("plaats", $plaats, $keuzemogelijkheid->plaatsId, array('class'=>'form-control')) ?>
   
    </div>
    <div class="form-group row">
        <label for="begin" class="col-form-label">Begin datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'begin', 'name'=>'beginTijdstip', 'readonly'=>TRUE,'title'=>'Vul hier de begin datum in.'),$keuzemogelijkheid->beginTijdstip,$datumAttributen); ?>
    </div>
    <div class="form-group row">
        <label for="einde" class="col-form-label">Eind datum en tijdstip:</label>
        <?php echo form_input(array('id'=>'begin', 'name'=>'eindTijdstip', 'readonly'=>TRUE, 'title'=>'Vul hier de eind datum in.'),$keuzemogelijkheid->eindTijdstip,$datumAttributen); ?>
    </div>
    <div class="form-group row">
        <label for="deadline" class="">Datum en tijdstip voor deadline:</label>
        <?php echo form_input(array('id'=>'begin', 'name'=>'deadlineTijdstip', 'readonly'=>TRUE, 'title'=>'Vul hier de datum in waarop ze ten laatste kunnen inschrijven.'),$keuzemogelijkheid->deadlineTijdstip,$datumAttributen); ?>
    </div>
    <?php
        echo form_hidden('jaar', $keuzemogelijkheid->jaargangId);
        echo form_hidden('id', $keuzemogelijkheid->id);
        echo form_button($arrayparameters);
        echo anchor('admin/dash/keuzemogelijkheidbeheer/'.$keuzemogelijkheid->jaargangId,'Annuleer','class="btn btn-warning"');
        echo form_close();
    ?>
    
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>            