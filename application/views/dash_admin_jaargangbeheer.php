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
        <div class="navbar">
            <!-- Links for contents -->
            <ul class="navbar-nav mr-auto">
            
            <?php
                if($data['jaargang']->actief){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/jaargangupdate/<?php echo $data['jaargang']->id; ?>">
                    Wijzig jaargang
                </a>
            </li>
            <?php
                }
            ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/keuzemogelijkheidbeheer/<?php echo $data['jaargang']->id; ?>">
                    Keuzemogelijkheden
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/vrijwilligersoverzicht/<?php echo $data['jaargang']->id; ?>">
                    Vrijwilligers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/deelnemersoverzicht/<?php echo $data['jaargang']->id; ?>">
                    Deelnemers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/personeelimporteren/<?php echo $data['jaargang']->id; ?>">
                    Personen
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/admin/dash/personeelimporteren/<?php echo $data['jaargang']->id; ?>">
                    Importeren
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- <div id="dHeader" class="row justify-content-md-center">
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
</div> -->