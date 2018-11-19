<div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header"><a class="navbar-brand" href="<?= Router::url("/admin/dashboard", true) ?>"><img style="height:50px" src="<?= Router::url("/img/logo.png", true) ?>" alt="Dinas Pemuda, Olahraga dan Pariwisata" title="<?= _APP_CORPORATE?>"></a></div>
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons"><span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i></button>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar"><span class="sr-only">Toggle navigation</span><i class="icon-paragraph-justify2"></i></button>
    </div>
    <?php
    $notifications = [];
    
        $notifications[] = [
            "message" => 'Contoh Notif',
            "time" => strtotime("2016-05-03 12:12:01"),
            "style" => [
                "icon" => "icon-envelop",
                "textType" => "text-success",
            ],
        ];
    $countNotif = count($notifications);
    array_multisort(array_column($notifications, "time"), SORT_DESC, $notifications);
    ?>
    <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-notification"></i>
                <?php
                if ($countNotif > 0) {
                    ?>
                    <span class="label label-default"><?= $countNotif ?></span>
                    <?php
                }
                ?>
            </a>
            <div class="popup dropdown-menu dropdown-menu-right">
                <div class="popup-header">
                    <span><?= __("Notifikasi") ?></span>
                </div>
                <ul class="activity">
                    <?php
                    if (!empty($notifications)) {
                        foreach ($notifications as $notification) {
                            ?>
                            <li>
                                <i class="<?= $notification["style"]["icon"] ?> <?= $notification["style"]["textType"] ?>"></i>
                                <div>
                                    <?= $notification["message"] ?>
                                    <span><?= $this->Html->getTimeago($notification["time"]); ?></span>
                                </div>
                            </li> 
                            <?php
                        }
                    } else {
                        ?>
                        <li class="text-center">Tidak ada notifikasi.</li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle sidebar-toggle">
                <i class="icon-paragraph-justify2"></i>
            </a>
        </li>
    </ul>
</div>