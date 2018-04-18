<?php
/* 
GREIF MATTHIAS
LAST UPDATED: 18 04 18
DASH ADMIN JAARGANG ADD/UPDATE
*/
    $defaults = [
        'id' => 0,
        'naam' => '',
        'thema' => '',
        'info' => '',
        'beginTijdstip' => '',
        'eindTijdstip' => ''
    ];

    if(isset($data['jaargang'])){
        $defaults['id'] = $data['jaargang']->id;
        $defaults['naam'] = $data['jaargang']->naam;
        $defaults['thema'] = $data['jaargang']['thema'];
        $defaults['info'] = $data['jaargang']['info'];
        $defaults['beginTijdstip'] = $data['jaargang']['beginTijdstip'];
        $defaults['eindTijdstip'] = $data['jaargang']['eindTijdstip'];
    }

    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = '0';
    $arrayparameters['type'] = 'submit';
    $arrayparameters['content'] = "Bevestig";
?>

<?php echo form_open('jaargang/update', array('name' => 'frmJaargang', 'id' => 'frmJaargang', 'role' => 'form'));  ?>

<label for="inpNaam">Naam:</label>
<input id="inpNaam" name="naam" type="text" value="<?php echo $defaults['naam']; ?>">
</br>
<label for="inpThema">Thema:</label>
<input id="inpThema" name="naam" type="text" value="<?php echo $defaults['thema']; ?>">
</br>
<label for="inpInfo">Info:</label>
<textarea id="inpInfo" name="naam" type="text" value="<?php echo $defaults['info']; ?>"></textarea>
</br>
<label for="begin">Begin datum en tijdstip:</label>
<input id="begin" name="beginTijdstip" size="16" type="text" value="<?php echo $defaults['beginTijdstip']; ?>" readonly class="form_datetime">
</br>
<label for="einde">Eind datum en tijdstip:</label>
<input id="einde" name="eindTijdstip" size="16" type="text" value="<?php echo $defaults['eindTijdstip']; ?>" readonly class="form_datetime">
</br>
<?php    
    echo form_button($arrayparameters);
    echo form_close();
?>


<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>            