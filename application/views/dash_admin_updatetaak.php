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
    echo $taak->beschrijving;

?>
    
    <?php echo form_open('taken/update', array('name' => 'taakFrom', 'id' => 'taakForm', 'role' => 'form'));  ?>
    </br>
    <label for="functie">Taaknaam:</label>
    <?php echo form_input(array('id'=>'functie', 'name'=>'functie'),$taak->functie); ?>
    </br>
    <label for="beschrijving">Beschrijving van de taak:</label>
    <textarea name="beschrijving" form="taakForm"><?php $taak->beschrijving ?></textarea>
    </br>
    </br>
    <?php
        echo $idData;    
        echo form_button($arrayparameters);
        echo anchor('admin/dash/takenbeheer/'.$keuzemogelijkheid->id,'Annuleer','class="btn btn-primary"');
        echo form_close();
    ?>