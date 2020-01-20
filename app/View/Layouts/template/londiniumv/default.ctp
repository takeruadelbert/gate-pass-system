<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title><?= _APP_NAME?> - <?= _APP_CORPORATE?></title>
        <link rel="icon" type="image/gif/png" href="<?= Router::url("/img/justlogo.png",true)?>">
        <?php
        $this->Template->import();
        ?>
    </head>
    <body class="sidebar-wide">
        <!-- Navbar -->
        <?php
        echo $this->element(_TEMPLATE_DIR . "/$template/navbar");
        ?>
        <!-- /navbar -->
        <!-- Page container -->
        <div class="page-container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <?php
                    echo $this->element(_TEMPLATE_DIR . "/$template/leftnav");
                    ?>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /sidebar -->
            <!-- Page content -->
            <div class="page-content">
                <?php
                echo $this->element(_TEMPLATE_DIR . "/$template/header");
                echo $this->element(_TEMPLATE_DIR . "/$template/breadcrumb");
                echo $this->element(_TEMPLATE_DIR . "/$template/flash-message");

                echo $this->fetch("content");
                ?>
            </div>
            <?php
            echo $this->element(_TEMPLATE_DIR . "/$template/footer");
            ?>
            <!-- /page content -->
        </div>
        <!-- /page container -->
        <?php
        echo $this->element(_TEMPLATE_DIR . "/$template/elements");
        echo $this->element(_TEMPLATE_DIR . "/$template/modals");
        ?>
    </body>
</html>