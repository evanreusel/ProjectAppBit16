<?php
/**
*button initialiseren voor de submit
*/
    $arrayparameters = array();
    $arrayparameters['id'] = 'submit';
    $arrayparameters['value']= 'submit';
    $arrayparameters['content'] = 'Personeelslijst toevoegen';
    ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

var error;
var errortitle;

/**
controle bestand
*/
function filecheck(){
    var file = $("#userfile").val();
    console.log(file);

    ///kijken of een persoonstype is gekozen
    var soortselected = false;
    
    $(".soortbutton").each(function(){
        if($(this).hasClass("btn-success")){
        soortselected = true;
        }
    });
    
    if(!soortselected){
        error = "Geleieve een Personnstype te kiezen" ; 
        errortitle = "Geen persoonstype";
        return false;
    }

    ///kijken of file in orde is
    /// indien er een probleem is wordt de foutboodschap aangepast
    if(file != ""){
    if(RegExp('\\.csv$').test(file)){     
        return true
        } else {
        error = "Geleieve een CSV- bestand te submitten" ; 
        errortitle = "Foute bestandstype"  ;
    }
    }else{
        error = "Gelieve eerst een bestand te kiezen vooraleer te submitten";
        errortitle = "Geen bestand gekozen"  ;
    }
    return false;    
}

/**
soort van de persoon kiezen
stijl knoppen in orde brengen
*/
function soortselect(){
    $(".soortbutton").click(function(){
        $(".soortbutton").each(function(){
            if($(this).hasClass("btn-success")){
                $(this).addClass("btn-secondary");
                $(this).removeClass("btn-success");
            }
        });
        
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-success");

        $("#soort").val($(this).val());
    });
}


 $(document).ready(function () {
 $("#errorpopup").hide();

 soortselect();

/**
indien de file in orde is wordt deze ingediend
indien er een probleem is wordt er een foutboodschap getoond
*/
 $("#submit").click(function(event){
     if(!filecheck()){
        event.preventDefault();
        $("#errormessage").text(error);
        $('#errorpopup').dialog();
        $('#errorpopup').dialog("option","title", errortitle);    
     }
     });

    $('#errorclose').click(function() {
         $('#errorpopup').dialog("close");
    });    
 });

    
</script>

    
<br/>

<div id="errorpopup"  title="Error">
<div id="errormessage"></div>
<button id="errorclose">OK</button>
</div>

<div id="soortselect">
    <button value="deelnemer" class="soortbutton btn btn-secondary">Deelnemers</button>
    <button value="vrijwilliger" class="soortbutton btn btn-secondary">Vrijwilligers</button>
</div>

<?php echo form_open('admin/excel', array('name' => 'fileform', 'id' => 'fileform', 'role' => 'form', 'enctype' => 'multipart/form-data'));?>

<a href="<?=base_url('assets/bestanden/template.csv');?>">template downloaden</a>
</br>
<a href="<?=base_url('assets/bestanden/template2.csv');?>">gebruik dit template indien het bovesnstaande template geen kolommen toont</a>
</br>
<input type="hidden" id="soort" name="soort" class="soort">
<label for="userfile">Kies een CSV-bestand om te importeren</label>
</br>
<input type="file" name="userfile" id="userfile" size="20">

</br></br>


 <?php    
        echo form_submit($arrayparameters);
        echo form_close();
    ?>
