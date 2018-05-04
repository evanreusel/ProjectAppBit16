<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'vrijwilligertoevoegen';
    $arrayparameters['content'] = "Voeg vrijwilliger toe";
    
?>

<script>
function veldencheck(){
    var naamcheck = false;
    var mailcheck = false;

    if($("#naam").val() != ""){
        $("#naamerror").hide();
        naamcheck = true;
    }else{
        $("#naamerror").show();
    }

    
    if($("#mail").val() != ""){
        $("#mailerror").hide();
        mailcheck = true;
    }else{
        $("#mailerror").show();
    }

    return mailcheck && naamcheck;
}



$(document).ready(function(){
    $("#mailerror").hide();
    $("#naamerror").hide();
    $("#vrijwilligertoevoegen").click(function(){
    if(veldencheck()){
        $("#vrijwilligerform").submit();
    }
    });
});
</script>

<?php
	$this->load->helper('form');
    echo form_open('deelnemer/vrijwilligertoevoegen', array('name' => 'vrijwilligerform', 'id' => 'vrijwilligerform', 'role' => 'form'));
?>
    <div>
    <label for="naam">naam*</label>
    <br>
    <input type="text" name="naam" id="naam" placeholder="vul hier een naam in">
    </div>
    <div id="naamerror">
    <label for="naam" style="color:red">Gelieve de naam van de vrijwilliger in te vullen</label>
    </div>
    <div>
    <label for="mail">mail*</label>
    <br>
    <input type="text" name="mail" id="mail" placeholder="vul hier een mail in">
    </div>
    <div id="mailerror">
    <label for="mail" style="color:red">Gelieve het mailadres van de vrijwilliger in te vullen</label>
    </div>
    <div>
    <label for="woonplaats">woonplaats</label>
    <br>
    <input type="text" name="woonplaats" id="woonplaats" placeholder="vul hier een woonplaats in">
    </div>
    <div>
    <label for="adres">adres</label>
    <br>
    <input type="text" name="adres" id="adres" placeholder="vul hier een adres in">
    </div>
    <br>
    <?php echo form_button($arrayparameters); ?>
    <br>
    <br>
    <div>* Deze velden zijn verplicht </div>
<?php echo form_close(); ?>