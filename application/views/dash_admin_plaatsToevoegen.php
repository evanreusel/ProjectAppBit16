<!-- 
    DAAN
    LAST UPDATED: 16 05 18
    DASH ADMIN PLAATS ADD/UPDATE
-->

<script>

/// ajax om object te tonen
function ajaxplaats(plaatsId){
    console.log("<?php echo site_url(); ?>" + '/plaats/jsonplaats/' + plaatsId);

    $.ajax({
        url: '<?php echo site_url(); ?>/plaats/jsonplaats/' + plaatsId,
        async: false,
        type: "GET",
        dataType:'json',
        success: function(data){            
            $('#naam').val(data['naam']);
            $('#locatie').val(data['locatie']);
            $('#pId').val(data['id']);
            
        }, error: function (xhr, status, error) {

            alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);

        }
    });
}

</script>
<!-- 
    Omschrijving van hoe de administrator deze pagina kan gebruiken
-->
<p class="tooling">
    Beheer hier de verschillende locaties die u wilt kunnen gebruiken doorheen de applicatie.
</p>

<div class="form-group">
    <?php
    $attributes = array('name' => 'plaats');
?>
    <table class="table">
        <tr class="colored">
            <th>Naam</th>
            <th>Plaats</th>
            <td></td>
            <td></td>
        </tr>
        
        <?php
        foreach ($plaatsen as $plaats) {
            echo "<tr><td>" . $plaats->naam . "</td><td>" . $plaats->locatie . "</td><td>" . '<button onclick="ajaxplaats(' . $plaats->id . ')" type="button" class="btn btn-warning btn-round wijzig" value="' . $plaats->id . '" title="Druk hier om deze locatie te wijzigen" >Wijzig</button>' . "</td><td>" .
            '<button class="verwijder btn btn-danger btn-round" data-toggle="modal" data-target="#taakModal" value="/Plaats/verwijder/' . $plaats->id . '" title="Druk hier om deze locatie te verwijderen">Verwijderen</button></td></tr>';
        }
        
        ?>
    </tbody>
    <table>
<?php
    echo form_open('plaats/registreer', $attributes);

/// Leeg locatieobject aanmaken voor wanneer er een nieuwe locatie wordt toegevoegd
$plaatsTest='';
$locatieTest='';
$locatieId = 0;

/// Als de plaats bestaat (en er dus op wijzig is geklikt van een bestaande plaats) worden de velden onderaan ingevuld
if(isset($huidigePlaats)){$plaatsTest = $huidigePlaats->naam; $locatieTest = $huidigePlaats->locatie; $locatieId = $huidigePlaats->id;} 
    echo form_labelpro('Naam', 'naam');
    echo form_input(array('name' => 'naam',
        'id' => 'naam',
        'value' => $plaatsTest,
        'class' => 'form-control',
        'required' => 'required'));
        
    echo '</br>';
    echo form_labelpro('Locatie', 'locatie');
    echo form_input(array('name' => 'locatie',
        'id' => 'locatie',
        'value' =>$locatieTest,
        'class' => 'form-control',
        'required' => 'required'));
    ?>
        <input type="hidden" value="<?php echo $locatieId; ?>" name="id" id="pId">
    <?php

    echo form_submit('knop', 'Verzenden');
    echo form_close();
    ?>

    <!-- 
        Dialog div om een pop-upvenster te laten verschijnen met de vraag of je zeker wilt verwijderen
    -->
</div>
<div class="modal fade" id="taakModal" tabindex="-1" role="dialog" aria-labelledby="modaltitel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitel">Shift verwijderen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modaltekst">Weet u zeker dat u deze shift wil verwijderen?</p>
      </div>
      <div class="modal-footer">
        <a id="verwijderenLocatie" class="btn btn-danger btn-round">Verwijderen</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuleer</button>
      </div>
    </div>
  </div>
</div>

<script>
/// JQuery script om de functie verwijder in de controller 'plaats' aan te roepen na het klikken op 'verwijder'
$('.verwijder').click(function(){
    $('#verwijderenLocatie').attr("href","<?php echo site_url() ?>" + $(this).val());
});
</script>
