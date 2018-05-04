<!-- 
    DAAN
    LAST UPDATED: 20 04 30
    DASH ADMIN PLAATS ADD/UPDATE
-->

<script>

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

<div class="form-group">
    <?php
    $attributes = array('name' => 'plaats');
?>
    <table class="table">
    <tr class="colored">
    <th>Naam</th> <th>Plaats</th> </tr>
        <?php
        foreach ($plaatsen as $plaats) {
            echo "<tr><td>" . $plaats->naam . "</td><td>" . $plaats->locatie . "</td><td>" . '<button onclick="ajaxplaats(' . $plaats->id . ')" type="button" class="btn btn-danger btn-round wijzig" value="' . $plaats->id . '" title="Druk hier om deze locatie te wijzigen" >Wijzig</button>' . "</td><td>" .
            anchor('Plaats/verwijder/' . $plaats->id, '<button type="button" class="btn btn-danger btn-round" title="Druk hier om deze locatie te verwijderen">Remove</button>') .  '</td></tr>';
        }
        
        ?>
    </tbody>
    <table>
<?php
    echo form_open('plaats/registreer', $attributes);

// testen of plaats leeg is
$plaatsTest='';
$locatieTest='';
$locatieId = 0;

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
</div>

