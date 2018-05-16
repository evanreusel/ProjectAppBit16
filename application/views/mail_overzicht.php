<div class="container">
    Op deze pagina kunt u mails versturen naar de deelnemers en/of vrijwilligers. U kunt de sjablonen voor deze mails beheren, of een individuele mail opstellen en ze van uw eigen emailadres versturen.
    <div class="card">
        <div class="card-header">
            Mailherinneringen
        </div>
        <div class="card-body">
            <p>Hier kunt u mailherinneringen opstellen aan de hand van een sjabloon. Deze mail wordt via een centraal emailadres verstuurd naar de ontvangers die u selecteert, op het aangegeven tijdstip.</p>
            <div class="card bg-success">
                <div class="card-header">
                    <a href="#modalReminder" class="open-herinneringvenster class=btn btn-block"
                       data-toggle="modal" data-target="#modalReminder"

                       data-reminder-id="0">Mailherinnering toevoegen</a>

                </div>
            </div>
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
    <div class="card">
        <div class="card-header">
            Individuele Mail versturen
        </div>
        <div class="card-body">
            <a href="#modalIndividueleMail" class="open-herinneringvenster class=btn btn-block"
               data-toggle="modal" data-target="#modalIndividueleMail"
               data-reminder-id="0">Selecteer ontvangers</a>
        </div>
    </div>

</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalReminder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wijzig Reminder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form action="<?= site_url(); ?>/mail/maakHerinnering/" method="post">
            <div class="modal-body">
                    <input type="hidden" value="0" name="id" id="modalReminderId">
                    <label for="modalReminderDatum">Datum:</label>
                    <input type="date" id="modalReminderDatum" name="datum">
                    <h5>Ontvangers</h5>
                    <?php
                    foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
                        if (!$keuzemogelijkheid->verbergen) { ?>
                            <div class="persoongroep">


                            <div class='card'>
                                <div class='card-header'><input type="checkbox" class="select-persoongroep" > Activiteit <?php echo $keuzemogelijkheid->naam ?></div>
                                <div class='card-body'>
                                    <?php
                                    foreach ($keuzemogelijkheid->taken as $taak) {
                                        if (!$taak->verbergen) {
                                            ?>

                                            <div class="persoongroep" id="vrijwilliger<?php echo $taak->id ?>">
                                                <p><b><input type="checkbox" class="select-persoongroep"
                                                           data-select="vrijwilliger<?php echo $taak->id ?>">
                                                        Vrijwilligers <?php echo $taak->functie ?></b></p>
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
                                                <br><br></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
                                        if (!$keuzeoptie->verbergen) {
                                            ?>
                                            <div class="persoongroep" id="deelnemer<?php echo $keuzeoptie->id ?>">
                                            <p><b><input type="checkbox" class="select-persoongroep"
                                                       data-select="deelnemer<?php echo $keuzeoptie->id ?>"> Deelnemers
                                                    "<?php echo $keuzeoptie->naam ?>"</b></p>
                                                <?php foreach ($keuzeoptie->personen as $persoon) {
                                                    ?>
                                                    <label><input type="checkbox" name="personen[]"
                                                                  value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                                    </label>
                                                    <?php
                                                } ?>
                                            <br><br></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            </div>
                            <?php
                        }

                    }
                    ?>
                <div class="persoongroep">
                    <div class="card">
                        <div class="card-header">
                            <input type="checkbox" class="select-persoongroep" > Niet ingeschreven deelnemers
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
                </div>
                <div class="persoongroep">
                    <div class="card">
                        <div class="card-header">
                            <input type="checkbox" class="select-persoongroep" > Niet ingeschreven vrijwilligers
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
                </div>
                    <label>Mailsjabloon</label>
                    <select id="modalMailsjabloon" name="mailsjabloon">
                        <?php foreach ($mailsjablonen as $sjabloon) {
                            ?>
                            <option value="<?php echo $sjabloon->id ?>">
                                <?php echo $sjabloon->naam ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalIndividueleMail">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verstuur individuele email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                    <label for="modalReminderDatum">Datum:</label>
                    <input type="date" id="modalReminderDatum" name="datum">
                    <h5>Ontvangers</h5>
                    <?php
                    foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
                        if (!$keuzemogelijkheid->verbergen) { ?>
                            <div class="persoongroep">


                            <div class='card'>
                                <div class='card-header'><input type="checkbox" class="select-persoongroep" > Activiteit <?php echo $keuzemogelijkheid->naam ?></div>
                                <div class='card-body'>
                                    <?php
                                    foreach ($keuzemogelijkheid->taken as $taak) {
                                        if (!$taak->verbergen) {
                                            ?>

                                            <div class="persoongroep" id="vrijwilliger<?php echo $taak->id ?>">
                                                <p><b><input type="checkbox" class="select-persoongroep"
                                                           data-select="vrijwilliger<?php echo $taak->id ?>">
                                                        Vrijwilligers <?php echo $taak->functie ?></b></p>
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
                                                <br><br></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
                                        if (!$keuzeoptie->verbergen) {
                                            ?>
                                            <div class="persoongroep" id="deelnemer<?php echo $keuzeoptie->id ?>">
                                            <p><b><input type="checkbox" class="select-persoongroep"
                                                       data-select="deelnemer<?php echo $keuzeoptie->id ?>"> Deelnemers
                                                    "<?php echo $keuzeoptie->naam ?>"</b></p>
                                                <?php foreach ($keuzeoptie->personen as $persoon) {
                                                    ?>
                                                    <label><input type="checkbox" name="personen[]"
                                                                  value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                                    </label>
                                                    <?php
                                                } ?>
                                            <br><br></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            </div>
                            <?php
                        }

                    }
                    ?>
                <div class="persoongroep">
                    <div class="card">
                        <div class="card-header">
                            <input type="checkbox" class="select-persoongroep" > Niet ingeschreven deelnemers
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
                </div>
                <div class="persoongroep">
                    <div class="card">
                        <div class="card-header">
                            <input type="checkbox" class="select-persoongroep" > Niet ingeschreven vrijwilligers
                        </div>
                        <div class="card-body">
                            <div class="select-persoongroep">
                                <?php
                                foreach ($nietingeschrevenVrijwilligers as $persoon) {
                                    ?>
                                    <label><input type="checkbox" name="personen[]"
                                                  data-email="<?php echo $persoon->mail ?>" value="<?php echo $persoon->id ?>"> <?php echo $persoon->naam ?>
                                    </label>

                                    <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>


                </div>

            <div class="modal-footer">
                <button type="button" id="genereer-mailto" class="btn btn-primary">Open mail</button>
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
        $("#genereer-mailto").click(function () {
            console.log("GENEREER MAILTO");
            ontvangers = $("#modalIndividueleMail :checked").not('.select-persoongroep');
            emails = [];
            for (i = 0; i < ontvangers.length; i++) {
                emails.push($('this').data('email'))
            }
            document.location.href = "mailto:bcc=" + emails.join();
        });
        $(".open-herinneringvenster").click(function ()
        {
            $("#modalReminder :checkbox").prop('checked', false);
            console.log("HERINNERING");

            var herinneringId = $(this).data('reminder-id');
            $("#herinnering-id").val(herinneringId);
            if (herinneringId != 0) {
                $("#modalReminderId").val($(this).data('reminder-id'));
                // herinnering velden bewerken
                $("#modalReminderDatum").val($(this).data('reminder-datum'));
                $("#modalMailsjabloon").val($(this).data('sjabloon-id'));
                // vul checkboxes in

                $.ajax({
                    url: '<?= site_url(); ?>/mail/getPersonenInHerinnering/' + herinneringId,
                    type: "GET",
                    dataType:'json',
                    success: function(data){
                        console.log(data);
                        for (i = 0; i < data.length; i++) {
                            console.log(data[i].persoonId);
                            $('input[name="personen[]"][value='+ data[i].persoonId +']').prop("checked", true);

                        }

                    }
                });
            }
            else
                {

                }
        });
        $(".select-persoongroep").change(function () {
            console.log("SELECTEER PERSONENGROEP");
            select = $(this).data('select');
            console.log(select);
            $('#' + select + " :checkbox").prop("checked", this.checked);
            $(this).closest(".persoongroep").find(":checkbox").prop("checked", this.checked);

        });
    });


</script>