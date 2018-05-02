<?php
	$this->load->helper('form');
    echo form_open('deelnemer/vrijwilligertoevoegen', array('name' => 'vrijwilligerform', 'id' => 'vrijwilligerform', 'role' => 'form'));
?>
    <label for="naam">naam</label>
    <br>
    <input type="text" name="naam" id="naam" placeholder="vul hier een naam in">
    <br>
    <label for="mail">mail</label>
    <br>
    <input type="text" name="mail" id="mail" placeholder="vul een hier mail in">
    <br>
    <label for="woonplaats">woonplaats</label>
    <br>
    <input type="text" name="woonplaats" id="woonplaats" placeholder="vul hier een woonplaats in">
    <br>
    <label for="adres">adres</label>
    <br>
    <input type="text" name="adres" id="adres" placeholder="vul hier een adres in">
    <br>
    <br>
    <button id="submit">Persoon toevoegen</button>
<?php echo form_close(); ?>