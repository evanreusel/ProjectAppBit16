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
            <?php echo $jaargang->actief; ?>
        </td>
    </tr>
    <?php } ?>
</table>