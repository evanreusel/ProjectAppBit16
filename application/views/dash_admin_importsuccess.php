<script>
laatstgesorteerd = "";
asc = true;

/**
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

/**
*De search functie zorgt ervoor dat als je op een veld met een 'search' class drukt alle onderliggende elementen alphabetisch gesorteerd worden
*Een vereiste hiervoor is dat de header de class 'search' en het id 'Xsearch' heeft
*Alle onderliggende elementen moeten de class 'X' hebben waarbij X de naam van de header is.
*De functie
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

/**
*De search functie zorgt ervoor dat als je op een veld met een 'search' class drukt alle onderliggende elementen alphabetisch gesorteerd worden
*Een vereiste hiervoor is dat de header de class 'Xsort' en het id 'sort' heeft
*Alle onderliggende elementen moeten de class 'X' en de class 'sortable' hebben waarbij X de naam van de header is.
*De functie
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

    /**
    * icons aanpassen naar de juiste sorteervolgorde
    */
    if(attribuut == laatstgesorteerd && asc){
    $(this).children("i").addClass("fas fa-angle-down");
        asc = false;
    } else {
    $(this).children("i").addClass("fas fa-angle-up");
        asc = true;
    }
    laatstgesorteerd = attribuut;
    
    console.log(asc);

     /**
    * lijst ophalen met alle elementen die gesorteerd moeten worden
    */ 
    rijen = document.getElementsByClassName(attribuut + "item");
    console.log(rijen);

    for (i = 0; i < (rijen.length - 1); i++) {
    wissel = true;
    teller = i;

    do {

    /**
    * een lineaire sorteer functie:
    * checken of een element alfabetisch een hogere waarde heeft als het vorige element
    * indien de waarde hoer is worden deze 2 elementen verwisseld
    * dit gebeurd totdat het element een lagere waarde heeft als het vorige element
    */
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


<h2>Het importeren is succesvol</h2>
<table class="table">
<?php
$first = true;

echo "<tr class=\"colored\">";

/**
 *
 * Hier is een lijst met de namen van alle zoekvelden.
 * Het is belangrijk voor de search functie in jquery dat alle inputs
 * een class 'search' hebben en een id 'Xsearch' waarbij X de naam van het veld is 
 *
 */
foreach($personen[0] as $onderdeel => $item){
            echo  '<td id="' . $onderdeel . 'sort" class="sort" title="Druk her om te sortere op deze rij"><i></i>' . $onderdeel . '</td>';
}

echo "</tr><tr>";

/**
 *
 * Hier worden alle velden ingevuld met de bijhorende gegevens van de database
 * voor de search en de sort functie is het belangrijk dat de velden de class 'Xitem' hebben
 * waarbij X de naam van de rowheader is
 * Voor de sort functie moeten de velden de class sortable hebben
 *
 */
foreach($personen[0] as $onderdeel => $item){
    echo '<td><input type="text" id="' . $onderdeel  . 'search" class="search" title="Vul hier een waarde in om te zoeken naar een object waar deze waarde in voorkomt"></td>';
}


echo "</tr>";

foreach($personen as $persoon){
            echo "<tr>";
    foreach($persoon as $onderdeel => $item){
            echo  '<td class="' . $onderdeel . 'item sortable">' . $item . '</td>';
    }
    echo "</tr>";
}
?>
</table>