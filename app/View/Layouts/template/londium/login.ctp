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
    </head>
    <body>
        <?php
        echo $this->fetch("content");
        ?>
    </body>
</html>