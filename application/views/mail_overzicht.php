<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr class="table-info">
            <td>Verzenden op</td>
            <td>Ontvangers</td>
            <td>Onderwerp</td>
            <td>Bewerken</td>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($reminders as $reminder)
        {?>
            <tr>
                <td><?php echo $reminder->timer?></td>
                <td><?php echo $reminder->ontvangers?></td>
                <td><?php echo $reminder->sjabloon?></td>
                <td><a href="#" class="btn btn-warning">Verwijder</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <br>
    <a href="#" class="btn btn-success"/>
</div>