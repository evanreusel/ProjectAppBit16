<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr class="table-info">
            <th>Verzenden op</th>
            <th>Ontvangers</th>
            <th>Onderwerp</th>
            <th>Sjabloon</th>
            <th>Status</th>
            <th>Bewerken</th>

        </tr>
        </thead>

        <tbody>
        <?php foreach ($reminders as $reminder) {
        ?>

            <td><?php echo $reminder->timer?></td>
            <td><?php echo count($reminder->ontvangers)?> ontvangers</td>
            <td><?php echo $reminder->sjabloon->naam?></td>
            <td><?php echo $reminder->sjabloon->naam?></td>
            <td><?php echo $reminder->status?></td>
            <td></td>
        <?php }?>
        </tbody>
    </table>


</div>