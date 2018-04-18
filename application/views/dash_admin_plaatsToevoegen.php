<!-- 
    DAAN
    LAST UPDATED: 18 03 30
    DASH ADMIN PLAATS ADD/UPDATE
-->

<div class="form-group">
    <?php
    $attributes = array('name' => 'plaats');
?>
    <table  class="table table-condensed" >
    <thead><tr><th>Naam</th> <th>Plaats</th> </tr></thead><tbody>
        <?php
        foreach ($plaatsen as $plaats) {
            echo "<tr><td>" . $plaats->naam . "</td><td>" . $plaats->locatie . "</td><td>" . anchor('Plaats/wijzig/' . $plaats->id,  '<button type="button" class="btn btn-danger btn-round">Wijzig</button>') . "</td><td>" .
            anchor('Plaats/verwijder/' . $plaats->id, '<button type="button" class="btn btn-danger btn-round">Remove</button>') .  '</td></tr>';
        }
        
        ?>
    </tbody>
    <table>
<?php
    echo form_open('plaats/registreer', $attributes);

    echo form_labelpro('Naam', 'naam');
    echo form_input(array('name' => 'naam',
        'id' => 'naam',
        'value' => if(isset($huidigePlaats)){$huidigePlaats->naam }else {''},
        'class' => 'form-control',
        'required' => 'required'));
        
    echo '</br>';
    echo form_labelpro('Locatie', 'locatie');
    echo form_input(array('name' => 'locatie',
        'id' => 'locatie',
        'value' => if(isset($huidigePlaats)){$huidigePlaats->locatie }else {''},
        'class' => 'form-control',
        'required' => 'required'));

        if(isset($huidigePlaats)){ echo form_hidden('id', $huidigePlaats->id);}

    echo form_submit('knop', 'Verzenden');
    echo form_close();
    ?>
</div>