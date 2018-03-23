<?php
    // Set default navspecs
    $nav_specs = [
        'color' => 'primary-color',
        'links' => [],
        'actions' => []
    ];

    // Check custom
    if(isset($primaryColor)){
        $nav_specs['color'] = $primaryColor;    
    }

    if(isset($links)){
        $nav_specs['links'] = $links;
    }

    if(isset($actions)){
        $nav_specs['actions'] = $actions;
    }
?>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark <?php echo $nav_specs['color']; ?>">
    <img src="<?php echo base_url(); ?>assets/img/svg/logo.svg">

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="basicExampleNav">
            <!-- Links for contents -->
            <ul class="navbar-nav mr-auto">
            
            <?php foreach($nav_specs['links'] as $link){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $link['url']; ?>">
                        <?php echo $link['title']; ?>
                    </a>
                </li>
            <?php } ?>

            <!-- Dropdown for actions -->
            <?php if count($nav_specs['actions']) > 0) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach($nav_specs['actions'] as $action) { ?>
                            <a class="dropdown-item" href="<?php echo $action['url']; ?>">
                                <?php echo $action['title']; ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>

            </ul>
        </div>

    </nav>