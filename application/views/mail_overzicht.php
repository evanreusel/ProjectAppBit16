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
                <?php foreach ($mailsjablonen as $sjabloon) {?>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header"><?php echo $sjabloon->naam?></div>
                        <div class="card-body">
                            <?php echo $sjabloon->inhoud?>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group align-content-center btn-block">
                                <a href="#modalSjabloon" class="btn btn-success btn-block open-sjabloonvenster" data-toggle="modal" data-target="#modalSjabloon" data-sjabloon-naam="<?php echo $sjabloon->naam?>" data-sjabloon-inhoud="<?php echo $sjabloon->inhoud?>" data-sjabloon-id="<?php echo $sjabloon->id?>">Aanpassen</a>
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
                <?php
                foreach ($keuzemogelijkheden as $keuzemogelijkheid)
                {
                    if (!$keuzemogelijkheid->verbergen)
                    { ?>
                        <div class='card'>
                        <div class='card-header'>Activiteit <?php echo $keuzemogelijkheid->naam ?>: </div>
                        <div class='card-body'>
                        <?php

                        foreach ($keuzemogelijkheid->taken as $taak)
                        {
                            if (!$taak->verbergen)
                            {?>
                                <div class="taak">
                                <h5><input type="checkbox"> Vrijwilligers <?php echo $taak->functie ?></h5>
                                <?php
                                foreach ($taak->shiften as $shift)
                                {
                                    foreach ($shift->vrijwilligers as $persoon)
                                    {?>
                                         <label><input type="checkbox"> <?php echo $persoon->naam ?></label>
                                    <?php
                                    }
                                }?>
                                </div>
                            <?php}
                        }
                        ?>

                        <?php
                        foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie)
                        {
                            if (!$keuzeoptie->verbergen)
                            {?>
                                <h5>Deelnemers<?php echo $keuzeoptie->naam ?></h5>
                                <?php foreach ($keuzeoptie->personen as $persoon)
                                {?>
                                    <label><input type="checkbox"> <?php echo $persoon->naam ?></label>
                                <?php
                                }
                            }
                        }
                        ?>
                        </div>
                        </div>
<?php
                    }

                }
                foreach ($nietingeschrevenDeelnemers as $persoon)
                {?>
                    <label><input type="checkbox"> <?php echo $persoon->naam ?></label>

                    <?php
                }
                foreach ($nietingeschrevenVrijwilligers as $persoon)
                {?>
                    <label><input type="checkbox"> <?php echo $persoon->naam ?></label>

                    <?php
                }

                ?>
                <label>Mailsjabloon</label>
                <select id="form_mailsjabloon">
                    <?php foreach ($mailsjablonen as $sjabloon) {
                        ?>
                        <option value="<?php echo $sjabloon->id?>">
                            <?php echo $sjabloon->naam?>
                        </option>
                    <?php } ?>
                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalSjabloon">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wijzig Reminder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sjabloon-id"/>
                <label for="modalReminderDatum">Onderwerp:</label>
                <input type="text" id="sjabloon-naam">
                <h5>Tekst</h5>
                <i>Tip: je kan hier ook variabelen gebruiken.</i>
                <ul>
                    <li><i>$naam</i> voor de naam van de ontvanger;</li>
                    <li><i>$token</i> voor de link die de ontvanger gebruikt om naar de website te gaan;</li>
                    <li><i>$token</i> voor de link die de ontvanger gebruikt om naar de website te gaan;</li>
                    <li><i>$soort</i> voor de link die de ontvanger gebruikt om naar de website te gaan;</li>
                </ul>
                <textarea id="sjabloon-inhoud" class="form-control" placeholder="Beste $naam,&#10;Welkom! U kunt via deze link naar onze pagina gaan: $token"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleer</button>
            </div>
        </div>
    </div>
</div>
<script>

    $( document ).ready(function() {
        $( ".open-sjabloonvenster" ).click(function() {
            console.log("SJABLOON");
            var sjabloonId = $(this).data('sjabloon-id');
            $("#sjabloon-id").val(sjabloonId);
            if(sjabloonId != 0)
            {
                // sjabloon bewerken
                $("#sjabloon-naam").val($(this).data('sjabloon-naam'));
                $("#sjabloon-inhoud").val($(this).data('sjabloon-inhoud'));
            }
        });

    });

</script>