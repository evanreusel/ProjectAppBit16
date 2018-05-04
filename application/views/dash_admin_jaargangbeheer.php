<!--
    GREIF MATTHIAS
    LAST UPDATED: 18 05 02
    DASH ADMIN JAARGANGBEHEER
-->
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