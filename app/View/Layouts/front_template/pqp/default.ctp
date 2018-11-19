<!-- Front-End created by Yohanes Mario Chandra (http://yohanesmario.com) -->
<!-- Last Updated: 2014-09-15 ---------------------------------------------->
<!doctype html>
<html>
    <head>
        <!-- STYLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/normalize.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/jquery-ui.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/jquery-ui.structure.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/jquery-ui.theme.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/perfect-scrollbar.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/bootstrap/css/bootstrap.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/bootstrap/css/bootstrap.css", true) ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Router::url("/front_file/pqp/style/main.css", true) ?>" />

        <!-- SCRIPTS -->
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/script/jquery.js") ?>"></script>
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/script/jquery-ui.js") ?>"></script>
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/script/jquery.slides.js") ?>"></script>
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/script/perfect-scrollbar.js") ?>"></script>
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/bootstrap/js/bootstrap.min.js") ?>"></script>
        <script type="text/javascript" src="<?php echo Router::url("/front_file/pqp/script/main.js") ?>"></script>
        <script>
            var BASE_URL = '<?php echo Router::url("/", true) ?>';
        </script>
        <?php
        echo $this->Html->script("app");
        echo $this->Html->script("wonolib");
        ?>

    </head>
    <body>
        <?php
        echo $this->element(_FRONT_TEMPLATE_DIR . "/pqp/banner");
        echo $this->element(_FRONT_TEMPLATE_DIR . "/pqp/header");
        echo $this->element(_FRONT_TEMPLATE_DIR . "/pqp/navigation");
        echo $this->fetch("content");
        echo $this->element(_FRONT_TEMPLATE_DIR . "/pqp/footer");
        echo $this->element(_FRONT_TEMPLATE_DIR . "/pqp/element");
        ?>      
    </body>
</html>
