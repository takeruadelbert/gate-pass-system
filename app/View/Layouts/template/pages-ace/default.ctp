<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Pages - Admin Dashboard UI Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="apple-touch-icon" href="pages/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php
        $this->Template->import();
        ?>
        <script type="text/javascript">
            window.onload = function()
            {
                // fix for windows 8
                if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                    document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
            }
        </script>
    </head>
    <body class="fixed-header">
        <!-- BEGIN SIDEBAR -->
        <?php
        echo $this->element(_TEMPLATE_DIR."/pages-ace/sidebar");
        ?>
        <!-- END SIDEBAR -->
        <!-- START PAGE-CONTAINER -->
        <div class="page-container">
            <!-- START PAGE HEADER WRAPPER -->
            <!-- START HEADER -->
            <?php
            echo $this->element(_TEMPLATE_DIR."/pages-ace/header");
            ?>
            <!-- END HEADER -->
            <!-- END PAGE HEADER WRAPPER -->
            <!-- START PAGE CONTENT WRAPPER -->
            <div class="page-content-wrapper">
                <!-- START PAGE CONTENT -->
                <div class="content">
                    <!-- START JUMBOTRON -->
                    <div class="jumbotron" data-pages="parallax">
                        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                            <div class="inner">
                                <!-- START BREADCRUMB -->
                                <?php
                                echo $this->element(_TEMPLATE_DIR."/pages-ace/breadcrumb");
                                ?>
                                <!-- END BREADCRUMB -->
                            </div>
                        </div>
                    </div>
                    <!-- END JUMBOTRON -->
                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <?php
                        echo $this->element(_TEMPLATE_DIR."/pages-ace/flash-message");
                        ?>
                    </div>
                    <?php
                    echo $this->fetch("content");
                    ?>
                </div>
                <!-- END PAGE CONTENT -->
                <!-- START FOOTER -->
                <?php
                echo $this->element(_TEMPLATE_DIR."/pages-ace/footer");
                ?>
                <!-- END FOOTER -->
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTAINER -->
        <?php
        echo $this->element(_TEMPLATE_DIR."/pages-ace/quickview");
        ?>
        <!-- START OVERLAY -->
        <?php
        echo $this->element(_TEMPLATE_DIR."/pages-ace/overlay");
        ?>
        <!-- END OVERLAY -->
    </body>
</html>