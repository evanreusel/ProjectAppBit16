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
            <a href="admin/dash/jaargangupdate/<?php $data['jaargang']->id; ?>" href="btn btn-primary">
                <div class="content">
                    <i class="fa fa-edit"></i>
                    <p>
                        Edit
                    </p>
                </div>
            </a>
        </div>

        <div class="col">
            <?php echo anchor("admin/dash/keuzemogelijkheidbeheer/" . $data['jaargang']->id,'<i class="fa fa-folder"></i> Keuzemogelijkheden', array('class' => 'btn btn-primary')); ?>
        </div>
        <div class="col">
            <?php echo anchor("admin/dash/vrijwilligersoverzicht/" . $data['jaargang']->id,'<i class="fa fa-folder"></i> Vrijwilligers', array('class' => 'btn btn-primary')); ?>
        </div>
        <div class="col">
            <?php echo anchor("admin/dash/deelnemersoverzicht/" . $data['jaargang']->id,'<i class="fa fa-folder"></i> Deelnemers', array('class' => 'btn btn-primary')); ?>
        </div>
        <div class="col">
            <?php echo anchor("admin/dash/personeelimporteren/" . $data['jaargang']->id,'<i class="fa fa-folder"></i> Deelnemers', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
</div>