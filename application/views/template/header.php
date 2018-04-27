<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    HEADER VIEW
-->

<?php
    // Set default navspecs
    $nav_specs = [
        'color' => 'primary-color',
        'links' => [],
        'actions' => [],
        'user' => null,
        'homelink' => ''
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

    if(isset($user)){
        $nav_specs['user'] = $user;
    }

    if(isset($homelink)){
        $nav_specs['homelink'] = $homelink;
    }
?>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark <?php echo $nav_specs['color']; ?>">
    <a href="<?php echo $nav_specs['homelink']; ?>">
        <img src="<?php echo base_url(); ?>assets/img/svg/logo.svg">
    </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <!-- Links for contents -->
            <ul class="navbar-nav mr-auto">

            <?php foreach($nav_specs['links'] as $link){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $link['url'] . '"title="' . $link['hulp']; ?>">
                        <?php echo $link['title']; ?>
                    </a>
                </li>
            <?php } ?>

            <!-- Dropdown for actions -->
            <?php if(count($nav_specs['actions']) > 0) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user->username; ?>
                    </a>
                    
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
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item active">
                <a class="nav-link" data-toggle="modal" data-target="#helpModal">?</a>
                </li>
            </ul>
        </div>

    </nav>

<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="helpModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>