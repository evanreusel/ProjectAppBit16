<table class="table">
    <tr class="colored">
        <th>naam</th>
        <th>info</th>
        <th>thema</th>
        <th>beginTijdstip</th>
        <th>eindTijdstip</th>
        <th>actief</th>
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
                        echo '<a id="deactivate" data-id="' . $jaargang->id . '" class="btn btn-primary"><i class="fa fa-ban"></i> Afsluiten</a>';
                    }else{
                        echo 'Deze editie is nog bezig';
                    }
                }
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<script>
    $(document).ready(function () {
        $('#deactivate').click(function () {
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