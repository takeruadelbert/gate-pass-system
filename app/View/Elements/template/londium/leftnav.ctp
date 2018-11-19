<div class="user-menu dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?= Router::url('/', true).$this->Session->read("credential.admin.User.profile_picture") ?>">
        <div class="user-info">
            <?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata"))?><span><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id"))?></span>
        </div>
    </a>
    <div class="popup dropdown-menu dropdown-menu-right">
        <div class="thumbnail">
            <div class="thumb">
                <img src="<?= Router::url('/', true).$this->Session->read("credential.admin.User.profile_picture") ?>">
                <div class="thumb-options">
                    <span>
                        <a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
                        <a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>
                    </span>
                </div>
            </div>

            <div class="caption text-center">
                <h6><?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata"))?> <small><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id"))?></small></h6>
            </div>
        </div>

    </div>
</div>

<ul class="navigation">
    <li><a href="<?= Router::url("/admin/dashboard",true)?>"><span>Dashboard</span> <i class="icon-screen2"></i></a></li>
    <?php

    function leftSubMenu($menu, $urls) {
        if (!empty($menu)) {
            echo "<ul>";
            foreach ($menu as $subMenu) {
                $expandable = !empty($subMenu['content']) ? "expand" : '';
                $active = in_array($subMenu['alias'], $urls) ? "active" : "";
                if (!empty(array_intersect($urls, $subMenu['moduleLink']))) {
                    $active = "active";
                }
                $newtab = '';
                $icon = '';
                if (empty($subMenu['alias'])) {
                    $alias = "#";
                } elseif (strpos($subMenu['alias'], "http") !== false || strpos($subMenu['alias'], "https") !== false) {
                    $alias = $subMenu['alias'];
                    $newtab = 'target="_blank"';
                    $icon = '<i class="icon-new-tab"></i>';
                } else {
                    $alias = Router::url("/" . $subMenu['alias'], true);
                }
                echo "<li class='{$active}'><a href='{$alias}' class='{$expandable}' {$newtab}>{$icon} " . __($subMenu['label']) . "</a>";
                leftSubMenu($subMenu['content'], $urls);
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    foreach ($leftSideMenuData as $menu) {
        $expandable = !empty($menu['content']) ? "expand" : '';
        $newtab = '';
        $icon = '';
        if (empty($menu['alias'])) {
            $alias = "#";
        } elseif (strpos($menu['alias'], "http") !== false || strpos($menu['alias'], "https") !== false) {
            $alias = $menu['alias'];
            $newtab = 'target="_blank"';
            $icon = '<i class="icon-new-tab"></i>';
        } else {
            $alias = Router::url("/" . $menu['alias'], true);
        }
        ?>
        <li>
            <a href="<?= $alias ?>" class="<?= $expandable ?>" <?= $newtab ?>>
                <span><?= $icon . " " . __($menu['label']) ?></span> 
                <i class="<?= $menu['icon'] ?>"></i>
            </a>
            <?php
            leftSubMenu($menu['content'], $this->StnAdmin->getOtherUrlName($url));
            ?>
        </li>
        <?php
    }
    ?>
</ul>