<!-- 
    TIM SWERTS
    LAST UPDATED: 23 04 2018
    DASH ADMIN TAAk ADD/UPDATE
-->

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
    $arrayparameters['class'] = "btn btn-primary";
    

    if($token != true){
        $idData=form_hidden("id", $taak->id).form_hidden("keuzemogelijkheidId", $taak->keuzemogelijkheidId);
        $arrayparameters['content'] = "Aanpassen";
    }
    else{
        $idData=form_hidden("keuzemogelijkheidId", $keuzemogelijkheid->id);
        $data = "";
        $taak = new stdClass();
        $taak->id=$data;
        $taak->functie=$data;
        $taak->beschrijving=$data;

        $arrayparameters['content'] = "Toevoegen";

    };
?>
    
    <?php echo form_open('taken/update', array('name' => 'taakFrom', 'id' => 'taakForm', 'role' => 'form'));  ?>
    </br>
    <div class="form-group row">
    <label for="functie" class="col-form-label">Taaknaam:</label>
    <?php echo form_input(array('id'=>'functie', 'name'=>'functie', 'class'=>'form-control'),$taak->functie); ?>
    </div>
    <div class="form-group row">
    <label for="beschrijving" class="col-form-label">Beschrijving van de taak:</label>
    </br>
    <textarea name="beschrijving" form="taakForm" class="form-control"><?php echo $taak->beschrijving; ?></textarea>
    </div>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo anchor('admin/dash/takenbeheer/'.$keuzemogelijkheid->id,'Annuleer','class="btn btn-primary"');
        echo form_close();
    ?>