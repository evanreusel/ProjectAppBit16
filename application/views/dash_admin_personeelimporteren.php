<?php
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

function filecheck(){
    var file = $("#userfile").val();
    console.log(file);

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

 $(document).ready(function () {
 $("#errorpopup").hide();
 $("#submit").click(function(event){
     if(!filecheck()){
                event.preventDefault();
         console.log("error");  
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

<?php echo form_open('admin/excel', array('name' => 'fileform', 'id' => 'fileform', 'role' => 'form', 'enctype' => 'multipart/form-data'));?>

<label for="userfile">Kies een CSV-bestand om te importeren</label>
</br>
<input type="file" name="userfile" id="userfile" size="20">

</br></br>


 <?php    
        echo form_submit($arrayparameters);
        echo form_close();
    ?>
