<!--
    GREIF MATTHIAS
    LAST UPDATED: 18 05 09
    DASH ADMIN JAARGANGBEHEER
-->

<?php if($data['jaargang']->actief){ ?>
    <p class="tooling">
        Hier kan u de editie "<?php echo $data['jaargang']->naam; ?>" van <?php echo date("d-m-Y", strtotime($data['jaargang']->beginTijdstip)); ?> tot <?php echo date("d-m-Y", strtotime($data['jaargang']->eindTijdstip)); ?> bewerken. <br/>
    </p>
<?php } else { ?>
    <p class="tooling">
        Hier kan u de afgesloten editie "<?php echo $data['jaargang']->naam; ?>" bekijken. <br/>
    </p>
<?php } ?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Links for contents -->
        <ul class="nav nav-tabs buttonmenu">
            <?php
                if($data['jaargang']->actief){
            ?>
            <li>
                <a href="<?= base_url()?>index.php/admin/dash/jaargangupdate/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary"
                title="Pas details aan van de editie">Wijzig jaargang</a>
            </li>
            <?php
                }
            ?>

            <li>
                <a href="<?= base_url()?>index.php/admin/dash/keuzemogelijkheidbeheer/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary"
                title="Pas keuzemogelijkheden aan van de editie">Keuzemogelijkheden</a>
            </li>

            <li>
                <a href="<?= base_url()?>index.php/admin/dash/vrijwilligersoverzicht/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary"
                title="Bekijk vrijwilligers van de editie">Vrijwilligers</a>
            </li>

            <li>
                <a href="<?= base_url()?>index.php/admin/dash/deelnemersoverzicht/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary"
                title="Bekijk deelnemers van de editie">Deelnemers</a>
            </li>

            <li>
                <a href="<?= base_url()?>index.php/admin/dash/personeelimporteren/<?php echo $data['jaargang']->id; ?>" class="btn btn-warning"
                title="Importeer personen voor deze editie">
                    Importeren
                </a>
            </li>
        </ul>
    </div>
</nav>