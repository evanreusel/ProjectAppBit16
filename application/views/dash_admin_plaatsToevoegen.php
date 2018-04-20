<!-- 
    DAAN
    LAST UPDATED: 20 04 30
    DASH ADMIN PLAATS ADD/UPDATE
-->

<script>

function ajaxplaats(id){
            
                console.log("click");
                console.log('site_url(); ?>/plaats/jsonplaats/' + id);
            
            $.ajax({
                url: '<?= site_url(); ?>/plaats/jsonplaats/' + id,
                async: false,
                type: "GET",
                dataType:'json',
                success: function(data){        
                console.log("ok");         
                console.log(data);   
                    
                    $('#naam').val(data['naam']);
                    $('#locatie').val(data['locatie']);
                    $('#id').val(id);
                    
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
    <table  class="table table-condensed" >
    <thead><tr><th>Naam</th> <th>Plaats</th> </tr></thead><tbody>
        <?php
        foreach ($plaatsen as $plaats) {
            echo "<tr><td>" . $plaats->naam . "</td><td>" . $plaats->locatie . "</td><td>" . '<button onclick="ajaxplaats(' . $plaats->id .')" type="button" class="btn btn-danger btn-round wijzig" value="' . $plaats->id . '" >Wijzig</button>' . "</td><td>" .
            anchor('Plaats/verwijder/' . $plaats->id, '<button type="button" class="btn btn-danger btn-round">Remove</button>') .  '</td></tr>';
        }
        
        ?>
    </tbody>
    <table>
<?php
    echo form_open('plaats/registreer', $attributes);

// testen of plaats leeg is
$plaatsTest='';
$locatieTest='';

if(isset($huidigePlaats)){$plaatsTest = $huidigePlaats->naam; $locatieTest = $huidigePlaats->locatie;} 
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

        echo form_hidden(array('id'=>'id', 'value' => 0, 'name'=>'id'));

    echo form_submit('knop', 'Verzenden');
    echo form_close();
    ?>
</div>

