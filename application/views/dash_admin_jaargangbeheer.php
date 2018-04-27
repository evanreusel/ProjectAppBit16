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
    <div class="items">
        
        <div class="item">
            <a href="/index.php/admin/dash/jaargangupdate/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> Edit
            </a>
        </div>

        <div class="item">
            <a href="/index.php/admin/dash/keuzemogelijkheidbeheer/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <i class="fa fa-folder"></i> Keuzemogelijkheden
            </a>
        </div>

        <div class="item">
            <a href="/index.php/admin/dash/vrijwilligersoverzicht/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> Vrijwilligers
            </a>
        </div>

        <div class="item">
            <a href="/index.php/admin/dash/deelnemersoverzicht/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> Deelnemers
            </a>
        </div>

        <div class="item">
            <a href="/index.php/admin/dash/personeelimporteren/<?php $data['jaargang']->id; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> Personeel importeren
            </a>
        </div>
    </div>
</div>