<div class="form-group">
    <?php
    $attributes = array('name' => 'plaats');
    echo form_open('plaats/registreer', $attributes);

    echo form_labelpro('Naam', 'naam');
    echo form_input(array('name' => 'naam',
        'id' => 'naam',
        'value' => $plaats->naam,
        'class' => 'form-control',
        'required' => 'required'));

    echo '</br>';
    echo form_labelpro('Locatie', 'locatie');
    echo form_input(array('name' => 'locatie',
        'id' => 'locatie',
        'value' => $plaats->locatie,
        'class' => 'form-control',
        'required' => 'required'));


    echo form_hidden('id', $plaats->id);

    echo form_submit('knop', 'Verzenden');
    echo form_close();
    ?>
</div>

<?php
echo anchor('home', '<button class="btn">Terug</button>');
?>