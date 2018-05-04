<!--
    GREIF MATTHIAS
    LAST UPDATED: 18 05 02
    DASH ADMIN JAARGANGBEHEER
-->
<nav class="navbar navbar-expand-lg navbar-dark deep-purple">
        <a href="http://projectab16.ddns.net/index.php/admin/dash/">
            <img src="http://projectab16.ddns.net/assets/img/svg/logo.svg">
        </a>

        <div class="container">
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <!-- Links for contents -->
                <ul class="navbar-nav mr-auto">

                            <li class="nav-item active">
                    <a class="nav-link" href="http://projectab16.ddns.net/index.php/admin/dash/jaargangoverzicht/"title="Beheer het huidige jaargang en bekijk informatie over de vorige jaargangen">
                        Editiebeheer                    </a>
                </li>
                            <li class="nav-item active">
                    <a class="nav-link" href="http://projectab16.ddns.net/index.php/admin/dash/plaatsToevoegen/"title="Voeg nieuwe plaatsen toe of pas bestaande plaatsen aan">
                        Locaties                    </a>
                </li>
                            <li class="nav-item active">
                    <a class="nav-link" href="http://projectab16.ddns.net/index.php/mail/overzicht/">
                        Mails                    </a>
                </li>
             

                <!-- Dropdown for actions -->
                                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            TM                        </a>
                        
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                                            <a class="dropdown-item" href="http://projectab16.ddns.net/index.php/admin/dash/adminbeheer/">
                                    Administrators beheren                                </a>
                                                            <a class="dropdown-item" href="http://projectab16.ddns.net/index.php/admin/logout/">
                                    Log out                                </a>
                                                    </div>
                    </li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item active">
                <a class="nav-link" data-toggle="modal" data-target="#helpModal">?</a>
                </li>
            </ul>
        </div>

    </nav>

<div class="items">
    <?php
        if($data['jaargang']->actief){
    ?>
    <div class="item">
        <a href="<?= base_url()?>index.php/admin/dash/jaargangupdate/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i> Edit
        </a>
    </div>
    <?php
        }
    ?>

    <div class="item">
        <a href="<?= base_url()?>index.php/admin/dash/keuzemogelijkheidbeheer/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary">
            <i class="fa fa-folder"></i> Keuzemogelijkheden
        </a>
    </div>

    <div class="item">
        <a href="<?= base_url()?>index.php/admin/dash/vrijwilligersoverzicht/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i> Vrijwilligers
        </a>
    </div>

    <div class="item">
        <a href="<?= base_url()?>index.php/admin/dash/deelnemersoverzicht/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i> Deelnemers
        </a>
    </div>

    <div class="item">
        <a href="<?= base_url()?>index.php/admin/dash/personeelimporteren/<?php echo $data['jaargang']->id; ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i> Importeren
        </a>
    </div>
</div>

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