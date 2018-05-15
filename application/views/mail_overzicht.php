<div class="container">
    <div class="card">
        <div class="card-header">
            Mailherinneringen
        </div>
        <div class="card-body">

            <?php foreach ($reminders as $reminder) {
                ?>
                <div class="card">
                    <div class="card-header" id="reminderHoofding<?php echo $reminder->id ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#reminderInhoud<?php echo $reminder->id ?>" aria-expanded="false"
                                    aria-controls="reminderInhoud<?php echo $reminder->id ?>">
                                <?php echo $reminder->sjabloon->naam ?>" op <?php echo $reminder->timer ?>
                            </button>
                        </h5>
                    </div>
                    <div id="reminderInhoud<?php echo $reminder->id ?>" class="collapse"
                         aria-labelledby="reminderHoofding<?php echo $reminder->id ?>" data-parent="#accordion">
                        <div class="card-body">
                            <p><?php echo $reminder->timer ?></p>
                            <p><?php echo count($reminder->ontvangers) ?> ontvangers</p>
                            <p><?php echo $reminder->sjabloon->naam ?></p>
                            <p><?php echo $reminder->status ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group align-content-center btn-block">
                                <a href="#modalReminder" class="btn btn-success btn-block open-herinneringvenster"
                                   data-toggle="modal" data-target="#modalReminder"
                                   data-reminder-datum="<?php echo $reminder->timer ?>"
                                   data-reminder-id="<?php echo $reminder->id ?>"
                                   data-sjabloon-id="<?php echo $reminder->sjabloon->id ?>">Aanpassen</a>
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
                <?php foreach ($mailsjablonen as $sjabloon) { ?>
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header"><?php echo $sjabloon->naam ?></div>
                            <div class="card-body">
                                <?php echo $sjabloon->inhoud ?>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group align-content-center btn-block">
                                    <a href="#modalSjabloon" class="btn btn-success btn-block open-sjabloonvenster"
                                       data-toggle="modal" data-target="#modalSjabloon"
                                       data-sjabloon-naam="<?php echo $sjabloon->naam ?>"
                                       data-sjabloon-inhoud="<?php echo $sjabloon->inhoud ?>"
                                       data-sjabloon-id="<?php echo $sjabloon->id ?>">Aanpassen</a>
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
                <form id="reminderForm">
                    <input type="hidden" value="0" name="id" id="modalReminderId">
                    <label for="modalReminderDatum">Datum:</label>
                    <input type="date" id="modalReminderDatum">
                    <h5>Ontvangers</h5>
                    <?php
                    foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
                        if (!$keuzemogelijkheid->verbergen) { ?>
                            <div class='card'>
                                <div class='card-header'>Activiteit <?php echo $keuzemogelijkheid->naam ?> <div class="pull-right"><input type="checkbox"></div></div>
                                <div class='card-body'>
                                    <?php
                                    foreach ($keuzemogelijkheid->taken as $taak) {
                                        if (!$taak->verbergen) {
                                            ?>
                                            <h5><input type="checkbox" class="select-persoongroep"
                                                       data-select="vrijwilliger<?php echo $taak->id ?>">
                                                Vrijwilligers <?php echo $taak->functie ?></h5>
                                            <div class="persoongroep" id="vrijwilliger<?php echo $taak->id ?>">
                                                <?php
                                                foreach ($taak->shiften as $shift) {
                                                    foreach ($shift->vrijwilligers as $persoon) {
                                                        ?>
                                                        <label><input type="checkbox" name="personen[]"
                                                                      value="<?php echo $persoon->id ?>"
                                                                      data-soort="<?php echo $persoon->soort ?>"> <?php echo $persoon->naam ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
                                        if (!$keuzeoptie->verbergen) {
                                            ?>
                                            <h5><input type="checkbox" class="select-persoongroep"
                                                       data-select="deelnemer<?php echo $keuzeoptie->id ?>"> Deelnemers
                                                "<?php echo $keuzeoptie->naam ?>"</h5>
                                            <div class="persoongroep" id="deelnemer<?php echo $keuzeoptie->id ?>">
                                                <?php foreach ($keuzeoptie->personen as $persoon) {
                                                    ?>
                                                    <label><input type="checkbox" name="personen[]"
                                                                  value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                                    </label>
                                                    <?php
                                                } ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }

                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            Niet ingeschreven deelnemers
                        </div>
                        <div class="card-body">

                            <div class="select-persoongroep">


                                <?php
                                foreach ($nietingeschrevenDeelnemers as $persoon) {
                                    ?>
                                    <label><input type="checkbox" name="personen[]"
                                                  value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                    </label>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Niet ingeschreven vrijwilligers
                        </div>
                        <div class="card-body">
                            <div class="select-persoongroep">
                                <?php
                                foreach ($nietingeschrevenVrijwilligers as $persoon) {
                                    ?>
                                    <label><input type="checkbox" name="personen[]"
                                                  value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                    </label>

                                    <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <label>Mailsjabloon</label>
                    <select id="modalMailsjabloon">
                        <?php foreach ($mailsjablonen as $sjabloon) {
                            ?>
                            <option value="<?php echo $sjabloon->id ?>">
                                <?php echo $sjabloon->naam ?>
                            </option>
                        <?php } ?>
                    </select>
                </form>
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
                <textarea id="sjabloon-inhoud" class="form-control"
                          placeholder="Beste $naam,&#10;Welkom! U kunt via deze link naar onze pagina gaan: $token"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleer</button>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $(".open-sjabloonvenster").click(function () {
            console.log("SJABLOON");
            var sjabloonId = $(this).data('sjabloon-id');
            $("#sjabloon-id").val(sjabloonId);
            if (sjabloonId != 0) {
                // sjabloon bewerken
                $("#sjabloon-naam").val($(this).data('sjabloon-naam'));
                $("#sjabloon-inhoud").val($(this).data('sjabloon-inhoud'));

            }
        });
        $(".open-herinneringvenster").click(function () {
            console.log("HERINNERING");
            var herinneringId = $(this).data('reminder-id');
            $("#herinnering-id").val(herinneringId);
            if (herinneringId != 0) {
                $("#modalReminderId").val($(this).data('reminder-id'));
                // herinnering velden bewerken
                $("#modalReminderDatum").val($(this).data('reminder-datum'));
                $("#modalMailsjabloon").val($(this).data('sjabloon-id'));

            }
        });
        $(".select-persoongroep").change(function () {
            console.log("SELECTEER PERSONENGROEP");
            select = $(this).data('select');
            console.log(select);
            $('#' + select + " :checkbox").prop("checked", this.checked);

        });
    });


</script>