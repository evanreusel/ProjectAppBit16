<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    DASH ADMIN JAARGANGOVERZICHT
-->

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
            <?php echo $jaargang->beginTijdstip; ?> -> <?php echo $jaargang->eindTijdstip; ?>
        </td>
        <td>
            <?php
                if($jaargang->actief == 0){
                    echo "Afgesloten";
                }else{
                    if(new DateTime($jaargang->beginTijdstip) < new DateTime() && new DateTime($jaargang->eindTijdstip) < new DateTime())
                    {
                        echo '<a class="deactivate btn btn-primary" data-id="' . $jaargang->id . '"><i class="fa fa-ban"></i> Afsluiten</a>';
                    }else{
                        echo 'Deze editie is nog bezig';
                    }
                }

                echo '<td><a class="btn btn-warning" href="' . base_url() . 'index.php/admin/dash/jaargangbeheer/' . $jaargang->id . '"><i class="fa fa-folder-open-o"></i> Open</a></td>';
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<?php echo anchor("admin/dash/jaargangupdate/",'<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary fab')); ?>

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