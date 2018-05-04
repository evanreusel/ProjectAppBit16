<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    DASH ADMIN JAARGANGOVERZICHT
-->

<p class="tooling">
    Hier kan u de verschillende edities voor uw evenement beheren. <br/>
    LET OP: Er kan maar 1 editie tegelijkertijd actief zijn, om een nieuwe editie te kunnen starten moeten alle andere edities reeds afgesloten zijn. Eenmaal een editie afgesloten te hebben is er geen mogelijkheid meer deze terug te activeren.
</p>

<table class="table">
    <tr class="colored">
        <th>Naam</th>
        <th>Info</th>
        <th>Thema</th>
        <th>Datum range</th>
        <th>Actief</th>
        <td></td>
    </tr>

    <?php foreach($data['jaargangen'] as $jaargang){ ?>
    <tr>
        <td>
            <?php echo $jaargang->naam; ?>
        </td>
        <td>
            <?php echo $jaargang->info; ?>
        </td>
        <td>
            <?php echo $jaargang->thema; ?>
        </td>
        <td>
            van <?php echo date("d-m-Y", strtotime($jaargang->beginTijdstip)); ?> tot <?php echo date("d-m-Y", strtotime($jaargang->eindTijdstip)); ?>
        </td>
        <td>
            <?php
                if($jaargang->actief == 0){
                    echo "Afgesloten";
                }else{
                    $isnotcompleted = true;
                    if(new DateTime($jaargang->beginTijdstip) < new DateTime() && new DateTime($jaargang->eindTijdstip) < new DateTime())
                    {
                        echo '<a class="deactivate btn btn-primary" data-id="' . $jaargang->id . '" title="Druk hier om het huidige jaargang af te sluiten"><i class="fa fa-ban"></i> Afsluiten</a>';
                    }else{
                        echo 'Deze editie is bezig';
                    }
                }

                echo '<td><a class="btn btn-warning" href="' . base_url() . 'index.php/admin/dash/jaargangbeheer/' . $jaargang->id . '" title="Druk hier om alle informatie over dit jaargang te bekijken">Bekijk</a></td>';
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
    if(!isset($isnotcompleted)){
        echo anchor("admin/dash/jaargangupdate/",'<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary fab', 'title' => 'Druk hier om een nieuw jaargang te starten'));
    }
?>

<script>
    $(document).ready(function () {
        $('.deactivate').click(function () {
            var id = this.getAttribute("data-id");

            $.get('<?php echo base_url(); ?>index.php/jaargang/end/' + id, function (data) {
                if (data) {
                    window.location.href = '<?php echo base_url(); ?>index.php/admin/dash/jaargangoverzicht/';
                }else{
                    alert('Something went wrong deactivating jaargang');
                }
            });
        });
    });
</script>