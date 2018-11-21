<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title><?= _APP_NAME?> - <?= _APP_CORPORATE?></title>
        <?php
        $this->Template->import(array("application.js"));        
        ?>
        <link type="text/css" rel="stylesheet" href="<?= Router::url("/login/css/login.css") ?>" />
    </head>
    <?php
    $dataBGLogin = ClassRegistry::init("EntityConfiguration")->find("first");
    $bg_login_path = "";
    if(!empty($dataBGLogin['EntityConfiguration']['background_cover'])) {
        $bg_login_path = $dataBGLogin['EntityConfiguration']['background_cover'];
    }
    ?>
    <body class="bg-cover" style="background-image: url('<?= str_replace('\\', '/', Router::url("{$bg_login_path}", true)) ?>');">
        <div class="col-md-12 col-sm-12 col-xs-12 box-middleContent flex">
            <?php
            echo $this->fetch("content");
            ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 box-bottomShadow">
            <div class="col-md-12 col-sm-12 col-xs-12 footer-top font-PoppinsSemiBold center flex">
                <?= _APP_REFERENCE_NAME ?>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 box-bottomFooter font-PoppinsLight center flex">
                <div><?= _APP_NAME ?> | Copyright &copy; <?= $this->StnAdmin->copyrightYear(_APP_START)?> <?= _APP_CORPORATE ?> | Developed & Maintenance by <a target="_blank" href="<?= _DEVELOPER_WEBSITE ?>" style="color: white; font-weight: bold;"><?= _DEVELOPER_NAME ?></a></div>
            </div>
            <div class="box-support center">
                <div class="button-support font-PoppinsLight center center-block flex">
                    <a target="_blank" href="mailto:<?= _DEVELOPER_EMAIL ?>?Subject=Need%20Help">Bantuan</a>
                </div>
            </div>
        </div>
    </body>
</html>