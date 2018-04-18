<!-- 
    DAAN
    LAST UPDATED: 18 03 30
    DASH ADMIN PLAATS ADD/UPDATE
-->

<script>

function ajaxplaats(){
            $(".wijzig").click(function(){
            
            $.ajax({
                url: '<?= site_url(); ?>/plaats/ajaxplaats/' + $(this).val(),
                async: false,
                type: "GET",
                dataType:'json',
                success: function(data){             
                    
                    
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
});


        $(document).ready(function () {
                ajaxplaats();
            })
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
            echo "<tr><td>" . $plaats->naam . "</td><td>" . $plaats->locatie . "</td><td>" . '<button type="button" class="btn btn-danger btn-round wijzig" value="' . $plaats->id . ''" >Wijzig</button>' . "</td><td>" .
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

        if(isset($huidigePlaats)){ echo form_hidden('id', $huidigePlaats->id);}

    echo form_submit('knop', 'Verzenden');
    echo form_close();
    ?>
</div>