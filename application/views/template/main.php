<!-- 
    ERIK
    LAST UPDATED: 18 03 30
    MAIN VIEW
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $message; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/mdb.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" />
    <?php
        foreach ($css_files as $file)
        {?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/<?php  echo $file ?>" />
        <?php
        }
        ?>
</head>

<body>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mdb.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>

    <?php
    // =================================================================================================== GREIF MATTHIAS
        if(!isset($clearscreen)){
            $this->load->view('template/header');
        }

    ?>

    <div class="container">
    <?php
        $this->load->view($view);
    // =================================================================================================== /GREIF MATTHIAS
    ?>
    </div>

    <!--Footer-->
<footer class="footer font-small blue pt-4 mt-4">
<!--Copyright-->
<div class="footer-copyright py-3 text-center">
    UW NAAM HIER
</div>
<!--/.Copyright-->

</footer>
<!--/.Footer-->
</body>

</html>