<?php
/**
 * @brief overzicht van alle deelnemers
 *
 * Dit document toont een lijst van alle deelnemers 
 */
?>

<script>
laatstgesorteerd = "";
asc = true;

/*
*De hide functie gaat alle elementen verbergen met de class 'hidden'
*/
function hide(){
$("tr").each(function(){
    if($(this).is('[class*="hidden"]')){
        $(this).hide();
    }else{
        $(this).show();
    }
});
}

/*
*
*De search functie zorgt ervoor dat als je op een veld met een 'search' class drukt alle onderliggende elementen alphabetisch gesorteerd worden
*Een vereiste hiervoor is dat de header de class 'search' en het id 'Xsearch' heeft
*Alle onderliggende elementen moeten de class 'X' hebben waarbij X de naam van de header is.
*De functie
*
*/
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
/*
*
*De search functie zorgt ervoor dat als je op een veld met een 'search' class drukt alle onderliggende elementen alphabetisch gesorteerd worden
*Een vereiste hiervoor is dat de header de class 'Xsort' en het id 'sort' heeft
*Alle onderliggende elementen moeten de class 'X' en de class 'sortable' hebben waarbij X de naam van de header is.
*De functie
*
*/
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

</style>

<table class="table">

<?php
/**
 *
 * Hier is een lijst met de namen van alle velden die getoond worden.
 * Het is belangrijk voor de sort functie in jquery dat alle headers
 * een class 'sort' hebben en een id 'Xsort' waarbij X de naam van het veld is 
 *
 */
?>

<tHead>
<tr class="colored">
<td id="naamsort" class="sort" title="Druk her om te sortere op deze rij"><i></i> Naam</td>
<td id="mailsort" class="sort" title="Druk her om te sortere op deze rij"><i></i> Mail</td>
<td id="activiteitsort" class="sort" title="Druk her om te sortere op deze rij"><i></i> Activiteit</td>
<td id="tijdsort" class="sort" title="Druk her om te sortere op deze rij"><i></i> Tijd</td>
</tr>
</tHead>

<?php
/**
 *
 * Hier is een lijst met de namen van alle zoekvelden.
 * Het is belangrijk voor de search functie in jquery dat alle inputs
 * een class 'search' hebben en een id 'Xsearch' waarbij X de naam van het veld is 
 *
 */
?>

<tr>
<td><input type="text" id="naamsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="mailsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="activiteitsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
<td><input type="text" id="tijdsearch" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>
</tr>

<?php

/**
 *
 * Hier worden alle velden ingevuld met de bijhorende gegevens van de database
 * voor de search en de sort functie is het belangrijk dat de velden de class 'Xitem' hebben
 * waarbij X de naam van de rowheader is
 * Voor de sort functie moeten de velden de class sortable hebben
 *
 */
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