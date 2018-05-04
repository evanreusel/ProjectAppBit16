<div class="container">
    <div class="card">
        <div class="card-header">
            Mailherinneringen
        </div>
        <div class="card-body">

                <?php foreach ($reminders as $reminder) {
                    ?>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo $reminder->sjabloon->naam ?>" op <?php echo $reminder->timer ?>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p><?php echo $reminder->timer ?></p>
                                <p><?php echo count($reminder->ontvangers) ?> ontvangers</p>
                                <p><?php echo $reminder->sjabloon->naam ?></p>
                                <p><?php echo $reminder->status ?></p>
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
                <div class="col-lg-6">


                    <div class="card">
                        <div class="card-header">Onderwerp</div>
                        <div class="card-body">
                            Mail text blabla
                        </div>
                        <div class="card-footer">
                            <div class="btn-group align-content-center btn-block">
                                <a href="#" class="btn btn-success btn-block">Aanpassen</a>
                                <a href="#" class="btn btn-danger  btn-block">Verwijderen</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">


                    <div class="card">
                        <div class="card-header">Onderwerp</div>
                        <div class="card-body">
                            Mail text blabla 2
                        </div>
                        <div class="card-footer">
                            <div class="btn-group align-content-center btn-block">
                                <a href="#" class="btn btn-success btn-block">Aanpassen</a>
                                <a href="#" class="btn btn-danger  btn-block">Verwijderen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ontvangers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ontvangers_content">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>

</script>