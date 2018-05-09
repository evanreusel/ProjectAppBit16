<div class="container">
    <div class="card">
        <div class="card-header">
            Mailherinneringen
        </div>
        <div class="card-body">

                <?php foreach ($reminders as $reminder) {
                    ?>
                    <div class="card">
                        <div class="card-header" id="reminderHoofding<?php echo $reminder->id?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#reminderInhoud<?php echo $reminder->id?>" aria-expanded="false" aria-controls="reminderInhoud<?php echo $reminder->id?>">
                                    <?php echo $reminder->sjabloon->naam ?>" op <?php echo $reminder->timer ?>
                                </button>
                            </h5>
                        </div>
                        <div id="reminderInhoud<?php echo $reminder->id?>" class="collapse" aria-labelledby="reminderHoofding<?php echo $reminder->id?>" data-parent="#accordion">
                            <div class="card-body">
                                <p><?php echo $reminder->timer ?></p>
                                <p><?php echo count($reminder->ontvangers) ?> ontvangers</p>
                                <p><?php echo $reminder->sjabloon->naam ?></p>
                                <p><?php echo $reminder->status ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group align-content-center btn-block">
                                    <a href="#modalReminder" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalReminder">Aanpassen</a>
                                    <button class="btn btn-danger  btn-block">Verwijderen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Mailsjablonen</div>
        <div class="card-body">
            <div class="row row-eq-height">
                <?php foreach ($mailsjablonen as $sjabloon) {
                ?>
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-header"><?php echo $sjabloon->naam?></div>
                        <div class="card-body">
                            <?php echo $sjabloon->inhoud?>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group align-content-center btn-block">
                                <a href="#" class="btn btn-success btn-block">Aanpassen</a>
                                <a href="#" class="btn btn-danger  btn-block">Verwijderen</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<div class="modal" tabindex="-1" role="dialog" id="modalReminder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wijzig Reminder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="modalReminderDatum">Datum:</label>
                <input type="date" id="modalReminderDatum">
                <h5>Ontvangers</h5>
                <label><input type="radio" name="geactiveerd" value="0">Geactiveerd</label><br>
                <label><input type="radio" name="geactiveerd" value="1">Niet geactiveerd</label><br>
                <label><input type="radio" name="geactiveerd" value="-1">Alle</label><br>
                <h5>Type ontvanger</h5>
                <label><input type="radio" name="typeOntvanger" value="0">Vrijwilliger</label><br>
                <label><input type="radio" name="typeOntvanger" value="1">Deelnemer</label><br>
                <label><input type="radio" name="typeOntvanger" value="-1">Alle Types</label><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

</script>