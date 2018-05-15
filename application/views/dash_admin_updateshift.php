<!-- 
    TIM SWERTS
    LAST UPDATED: 23 04 2018
    DASH ADMIN shift ADD/UPDATE
-->

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    $arrayparameters['class'] = "btn btn-primary";
    

    if($token != true){
        $idData=form_hidden("id", $shift->id).form_hidden("taakId", $shift->taakId);
        $arrayparameters['content'] = "Aanpassen";
        $titel = $shift->naam.' aanpassen:';
    }
    else{
        $idData=form_hidden("taakId", $taak->id);
        $data = "";
        $shift = new stdClass();
        $shift->id=$data;
        $shift->naam=$data;
        $titel = 'Nieuwe shift aanmaken:';
        $arrayparameters['content'] = "Toevoegen";

    };
?>
    
    <?php echo form_open('shiften/update', array('name' => 'shiftFrom', 'id' => 'shiftForm', 'role' => 'form'));  ?>
    <h2><?php echo $titel ?></h2>
    <div class="form-group row">
    <label for="naam" class="col-form-label">shiftnaam:</label>
    <?php echo form_input(array('id'=>'naam', 'name'=>'naam', 'class'=>'form-control'),$shift->naam); ?>
    </div>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo anchor('admin/dash/takenbeheer/'.$taak->keuzemogelijkheidId,'Annuleer','class="btn btn-primary"');
        echo form_close();
    ?>