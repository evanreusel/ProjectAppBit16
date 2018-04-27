<!--
    GREIF MATTHIAS
    LAST UPDATED: 18 04 27
    DASH ADMIN JAARGANGBEHEER
-->

<div id="dHeader" class="row justify-content-md-center">
    <div class="col-10">
        <h1>
            <?php
                echo $data['jaargang']->naam;
            ?>
        </h1>
        <br/>
        <p>
            <?php
                echo $data['jaargang']->info;
            ?>
        </p>
        <br/>
        <p>
            <?php
                echo $data['jaargang']->beginTijdstip . ' > ' . $data['jaargang']->eindTijdstip;
            ?>
        </p>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="row col-10">
    <div class="col">
            <a href="admin/dash/jaargangupdate/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <div class="content">
                    <div>
                    <i class="fa fa-edit"></i>
                    <p>
                        Edit
                    </p>
</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin/dash/keuzemogelijkheidbeheer/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <div class="content">
                    <div>
                    <i class="fa fa-folder"></i>
                    <p>
                        Keuzemogelijkheden
                    </p>
</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin/dash/vrijwilligersoverzicht/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <div class="content">
                    <div>
                    <i class="fa fa-edit"></i>
                    <p>
                        Vrijwilligers
                    </p>
</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin/dash/deelnemersoverzicht/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <div class="content">
                    <div>
                    <i class="fa fa-edit"></i>
                    <p>
                        Deelnemers
                    </p>
</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin/dash/personeelimporteren/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <div class="content">
                    <div>
                    <i class="fa fa-edit"></i>
                    <p>
                        Personeel importeren
                    </p>
</div>
                </div>
            </a>
        </div>
    </div>
</div>