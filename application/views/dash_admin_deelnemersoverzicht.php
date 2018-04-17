<script>
laatstgesorteerd = "";
asc = true;

function search(){
$(".search").keyup(function(){
    waarde = $(this).val().toLowerCase();
    attribuut = $(this).attr('id');
    attribuut = attribuut.replace('search',''); 

    console.log(waarde);

    $('.' + attribuut + 'item').each(function(){
        console.log($(this).html());
        if($(this).html().toLowerCase().indexOf(waarde) >= 0 || waarde == ""){
            $(this).parent().show();
        } else {
            $(this).parent().hide();
        }
    });
});
}

function sort(){
    $(".sort").click(function(){

    attribuut = $(this).attr('id');
    attribuut = attribuut.replace('sort',''); 

    if(attribuut == laatstgesorteerd && asc){
        asc = false;
    } else {
        asc = true;
    }
    laatstgesorteerd = attribuut;
    
    console.log(asc);

    rijen = document.getElementsByClassName(attribuut + "item");
    console.log(rijen);

    for (i = 0; i < (rijen.length - 1); i++) {
    wissel = true;
    teller = i;

    do {

    hoger = rijen[teller].innerHTML.toLowerCase() > rijen[teller+1].innerHTML.toLowerCase();
    if( (hoger && asc) || (!hoger && !asc)){
    rijen[teller].closest('tr').parentNode.insertBefore(rijen[teller + 1].closest('tr'), rijen[teller].closest('tr'));
    teller = teller - 1;
    console.log("ok");
    } else {
        wissel = false;
        console.log("nxt");
    }
    }while(wissel && teller >= 0);

    }


    });
}

$(document).ready(function () {
search();
sort();
});

</script>

<style>

table,td  {    
    border-collapse: collapse;
    border-style: solid;
    border-color: #0066ff;
    border-width: 2px;
    }

);

</style>

<table>

<tHead>
<tr>
<td id="naamsort" class="sort">Naam</td>
<td id="mailsort" class="sort">Mail</td>
<td id="activiteitsort" class="sort">Activiteit</td>
<td id="tijdsort" class="sort">Tijd</td>
</tr>
</tHead>

<tr>
<td><input type="text" id="naamsearch" class="search"></td>
<td><input type="text" id="mailsearch" class="search"></td>
<td><input type="text" id="activiteitsearch" class="search"></td>
<td><input type="text" id="tijdsearch" class="search"></td>
</tr>

<?php

foreach($deelnemers as $deelnemer){
    foreach($deelnemers[$deelnemer] as $keuzeoptie){
    echo "<tr>";
    echo "<td class=\"naamitem sortable\"> $deelnemer->naam </td>";
    echo "<td class=\"mailitem sortable\"> $deelnemer->mail </td>";
    $naam = $keuzeoptie->naam;
    echo "<td class=\"activiteititem sortable\"> $naam </td>";
    $tijd = $keuzeoptie->keuzemogelijkheid->beginTijdstip;
    echo "<td class=\"tijditem sortable\"> $tijd </td>";
    echo "</tr>";
    }
}


?>

</table>