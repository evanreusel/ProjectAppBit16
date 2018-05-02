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

.sort:hover {cursor: pointer};

);

</style>

<table class="table">

<tHead>
<tr class="colored">
<td id="naamsort" class="sort"><i></i>Naam</td>
<td id="mailsort" class="sort" title="Druk her om te sortere op deze rij"><i></i>Mail</td>
<td id="taaksort" class="sort" title="Druk her om te sortere op deze rij"><i></i>Taak</td>
<td id="shiftsort" class="sort" title="Druk her om te sortere op deze rij"><i></i>Shift</td>
<td id="tijdsort" class="sort" title="Druk her om te sortere op deze rij"><i></i>Tijd</td>
</tr>
</tHead>

<tr>
<td><input type="text" id="naamsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="mailsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="taaksearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="shiftsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="tijdsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
</tr>

<?php

foreach($data['vrijwilligers'] as $vrijwilliger){
    foreach($vrijwilliger as $shift){
    echo "<tr>";
    echo "<td class=\"naamitem sortable\"> $vrijwilliger->naam </td>";
    echo "<td class=\"mailitem sortable\"> $vrijwilliger->mail </td>";
    $naam = $shift->taak->functie;
    echo "<td class=\"taakititem sortable\"> $naam </td>";
    $tijd = $shift->naam;
    echo "<td class=\"shiftitem sortable\"> $tijd </td>";
    $tijd = $shift->taak->keuzemogelijkheid->beginTijdstip;
    echo "<td class=\"tijditem sortable\"> $tijd </td>";
    echo "</tr>";
    }
}


?>

</table>