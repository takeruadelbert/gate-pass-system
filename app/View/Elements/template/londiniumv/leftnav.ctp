<div class="user-menu dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?= Router::url('/', true) . $this->Session->read("credential.admin.User.profile_picture") ?>">
        <div class="user-info">
            <?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata")) ?><span><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id")) ?></span>
        </div>
    </a>
    <div class="popup dropdown-menu dropdown-menu-right">
        <div class="thumbnail">
            <div class="thumb">
                <img src="<?= Router::url('/', true) . $this->Session->read("credential.admin.User.profile_picture") ?>">
                <div class="thumb-options">
                    <span>
                        <a class="btn btn-icon btn-success" onclick="modalChangepp()"><i class="icon-pencil"></i></a>
                    </span>
                </div>
            </div>

            <div class="caption text-center">
                <h6><?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata")) ?> <small><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id")) ?></small></h6>
            </div>
        </div>

    </div>
</div>
<ul class="navigation">
    <li class="<?= $url == "admin/dashboard" ? "active" : "" ?>"><a href="<?= Router::url("/admin/dashboard", true) ?>"><span>Dashboard</span> <i class="icon-screen2"></i></a></li>
    <li class="<?= $url == "admin/employees/profil" ? "active" : "" ?>"><a href="<?= Router::url("/admin/employees/profil", true) ?>"><span>Profil Anda</span> <i class="icon-user"></i></a></li>
    <?php

    function leftSubMenu($menu, $urls) {
        global $MID;
        if (!empty($menu)) {
            echo "<ul>";
            foreach ($menu as $subMenu) {
                $expandable = !empty($subMenu['content']) ? "expand" : '';
                $active = ($MID == "submenu_{$subMenu["submenuId"]}") ? "active" : "";
                $newtab = '';
                $icon = '';
                if (empty($subMenu['alias'])) {
                    $alias = "#";
                } elseif (strpos($subMenu['alias'], "http") !== false || strpos($subMenu['alias'], "https") !== false) {
                    $alias = $subMenu['alias'];
                    $newtab = 'target="_blank"';
                    $icon = '<i class="icon-new-tab"></i>';
                } else {
                    $alias = Router::url("/" . $subMenu['alias'] . "?mID=submenu_{$subMenu["submenuId"]}", true);
                }
                echo "<li class='{$active}'><a href='{$alias}' class='{$expandable}' {$newtab}>{$icon} " . __($subMenu['label']) . "</a>";
                leftSubMenu($subMenu['content'], $urls);
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    foreach ($leftSideMenuData as $menu) {
        $urls = $this->StnAdmin->getOtherUrlName($url);
        $expandable = !empty($menu['content']) ? "expand" : '';
        $newtab = '';
        $icon = '';
        $active = $MID == "menu_{$menu["menuId"]}" ? "active" : "";
        if (empty($menu['alias'])) {
            $alias = "#";
        } elseif (strpos($menu['alias'], "http") !== false || strpos($menu['alias'], "https") !== false) {
            $alias = $menu['alias'];
            $newtab = 'target="_blank"';
            $icon = '<i class="icon-new-tab"></i>';
        } else {
            $alias = Router::url("/" . $menu['alias'] . "?mID=menu_{$menu["menuId"]}", true);
        }
        ?>
        <li class="<?= $active ?>">
            <a href="<?= $alias ?>" class="<?= $expandable ?>" <?= $newtab ?>>
                <span><?= $icon . " " . __($menu['label']) ?></span> 
                <i class="<?= $menu['icon'] ?>"></i>
            </a>
            <?php
            leftSubMenu($menu['content'], $urls);
            ?>
        </li>
        <?php
    }
    ?>
    <li class="<?= $url == "admin/accounts/change_password" ? "active" : "" ?>"><a href="<?= Router::url("/admin/accounts/change_password", true) ?>"><span>Ganti Kata Sandi</span> <i class="icon-lock"></i></a></li>
    <li><a href="<?= Router::url("/admin/logout", true) ?>"><span>Logout/Keluar Aplikasi</span> <i class="icon-exit"></i></a></li>
</ul>