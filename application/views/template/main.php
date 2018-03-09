<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $message; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/mdb.min.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css"/>
        <?php
        foreach ($css_files as $file)
        {?>
            <link rel="stylesheet" type="text/css" media="screen" href="assets/css/<?php  echo $file ?>"/>
        <?php
        }
        ?>
    </head>
    <body>
        <!--Navbar-->
        <?php
        $this->load->view('template/header');
        ?>
        <!--/.Navbar-->
        <?php
        $this->load->view($view);
        ?>
        <!--Footer-->
        <?php
        $this->load->view('template/footer');
        ?>
        <!--/.Footer-->
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/mdb.min.js"></script>
    </body>
</html>