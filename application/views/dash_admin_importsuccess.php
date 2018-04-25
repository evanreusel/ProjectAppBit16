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


<h2>Het importeren is succesvol</h2>
<table class="table">
<?php
$first = true;

echo "<tr class=\"colored\">";

foreach($personen[0] as $onderdeel => $item){
            echo  '<td id="' . $onderdeel . 'sort" class="sort" title="Druk her om te sortere op deze rij"><i></i>' . $onderdeel . '</td>';
}

echo "</tr><tr>";

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