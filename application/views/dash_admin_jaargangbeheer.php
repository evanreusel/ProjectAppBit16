<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    DASH ADMIN JAARGANGBEHEER
-->

<table class="table">
    <tr class="colored">
        <th>Naam</th>
        <th>Info</th>
        <th>Thema</th>
        <th>BeginTijdstip</th>
        <th>EindTijdstip</th>
        <th>Actief</th>
        <td class="tableaction_container"><?php echo anchor("admin/dash/jaargangupdate/",'<i class="fa fa-plus"></i> Toevoegen</a>', array('class' => 'tableaction btn btn-primary')); ?></td>
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
            <?php echo $jaargang->beginTijdstip; ?>
        </td>
        <td>
            <?php echo $jaargang->eindTijdstip; ?>
        </td>
        <td>
            <?php
                if($jaargang->actief == 0){
                    echo "Afgesloten";
                }else{
                    if(new DateTIme($jaargang->beginTijdstip) < new DateTime())
                    {
                        echo '<a class="deactivate btn btn-primary" data-id="' . $jaargang->id . '"><i class="fa fa-ban"></i> Afsluiten</a>';
                    }else{
                        echo 'Deze editie is nog bezig';
                    }
                }

                echo '<td><a class="btn btn-warning" href="' . base_url() . 'index.php/admin/dash/keuzemogelijkheidbeheer/' . $jaargang->id . '"><i class="fa fa-folder-open"></i> Keuzemogelijkheden</a></td>';
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<script>
    $(document).ready(function () {
        $('.deactivate').click(function () {
            var id = this.getAttribute("data-id");

            $.get('<?php echo base_url(); ?>index.php/jaargang/end/' + id, function (data) {
                if (data) {
                    window.location.href = '<?php echo base_url(); ?>index.php/admin/dash/jaargangbeheer/';
                }else{
                    alert('Something went wrong deactivating jaargang');
                }
            });
        });
    });
</script>