<!--
    GREIF MATTHIAS
    LAST UPDATED: 18 04 20
    DASH ADMIN JAARGANGBEHEER
-->

<div>
    <div id="dHeader" class="row justify-content-md-center">
        <div class="col-10">
            <h1>
                <?php
                    echo $data['jaargang']->naam;
                ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-10">
            <div class="col">
                <?php echo anchor("admin/dash/jaargangupdate/" . $data['jaargang']->id,'<i class="fa fa-edit"></i> Edit', array('class' => 'btn btn-primary')); ?>
            </div>
            <div class="col">
                <?php echo anchor("admin/dash/keuzemogelijkheidbeheer/" . $data['jaargang']->id,'<i class="fa fa-folder"></i> Keuzemogelijkheden', array('class' => 'btn btn-primary')); ?>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
</div>