<?php
/* 
GREIF MATTHIAS
LAST UPDATED: 18 04 25
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
        $defaults['thema'] = $data['jaargang']->thema;
        $defaults['info'] = $data['jaargang']->info;
        $defaults['beginTijdstip'] = $data['jaargang']->beginTijdstip;
        $defaults['eindTijdstip'] = $data['jaargang']->eindTijdstip;
    }
?>

<?php echo form_open('jaargang/update', array('name' => 'frmJaargang', 'id' => 'frmJaargang', 'role' => 'form'));  ?>
<input name="id" type="hidden" value="<?php echo $defaults['id']; ?>">

<div class="md-form">
    <input type="text" name="naam" id="inpNaam" class="form-control" value="<?php echo $defaults['naam']; ?>">
    <label for="inpNaam">Naam:</label>
</div>

<div class="md-form">
    <input type="text" name="thema" id="inpThema" class="form-control" value="<?php echo $defaults['thema']; ?>">
    <label for="inpThema">Thema:</label>
</div>

<div class="md-form">
    <input type="text" name="naam" id="inpInfo" class="form-control" value="<?php echo $defaults['info']; ?>">
    <label for="inpInfo">Info:</label>
</div>

<div class="md-form">
    <input type="date" name="beginTijdstip" value="<?php echo $defaults['eindTijdstip']; ?>" readonly>
    <label for="begin">Begin datum en tijdstip:</label>
</div>

<div class="md-form">
    <input type="date" name="eindTijdstip" value="<?php echo $defaults['eindTijdstip']; ?>" readonly>
    <label for="einde">Eind datum en tijdstip:</label>
</div>

<input type="submit" value="Bevestig" class="btn btn-primary">
<?php
    echo form_close();
?>   