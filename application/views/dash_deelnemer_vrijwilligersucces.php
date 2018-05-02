<h3> <?=$persoon->naam?> is toegevoegd </h3>

<div>
<?php
if(isset($persoon->mail && $persoon->mail != "")){
    echo "<p>Het Mailadres van $persoon->naam is $persoon->mail</p>";
}
if(isset($persoon->woonplaats && $persoon->woonplaats != "")){
    echo "<p>De woonplaats van $persoon->naam is $persoon->woonplaats</p>";
}
if(isset($persoon->adres && $persoon->adres != "")){
    echo "<p>Het adres van $persoon->naam is $persoon->adres</p>";
}
?>

</div>