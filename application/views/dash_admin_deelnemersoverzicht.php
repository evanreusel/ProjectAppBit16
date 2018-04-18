<script>
laatstgesorteerd = "";
asc = true;

function hide(){
$("tr").each(function(){
    if($(this).is('[class*="hidden"]')){
        $(this).hide();
    }else{
        $(this).show();
    }
});
}

function search(){
$(".search").keyup(function(){
    waarde = $(this).val().toLowerCase();
    attribuut = $(this).attr('id');
    attribuut = attribuut.replace('search',''); 

    console.log(waarde);

    $('.' + attribuut + 'item').each(function(){
        console.log($(this).html());
        if($(this).html().toLowerCase().indexOf(waarde) >= 0 || waarde == "" & $(this).hasClass("hidden" + attribuut)){
            $(this).parent().removeClass("hidden" + attribuut);
        } else {
            $(this).parent().addClass("hidden" + attribuut);
        }
    });
hide();
});
}

function sort(){
    $(".sort").click(function(){


    attribuut = $(this).attr('id');
    attribuut = attribuut.replace('sort',''); 

    $(".sort > i").each(function(){
        if($(this).hasClass("fa-angle-down")){
            $(this).removeClass("fa-angle-down");
        } else if($(this).hasClass("fa-angle-up")){
            $(this).removeClass("fa-angle-up");
        }
    });

    if(attribuut == laatstgesorteerd && asc){
    $(this).children("i").addClass("fas fa-angle-down");
        asc = false;
    } else {
    $(this).children("i").addClass("fas fa-angle-up");
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
<td id="naamsort" class="sort"><i></i>Naam</td>
<td id="mailsort" class="sort"><i></i>Mail</td>
<td id="activiteitsort" class="sort"><i></i>Activiteit</td>
<td id="tijdsort" class="sort"><i></i>Tijd</td>
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