<!-- BEGIN SIDEBAR MENU -->
<div class="sidebar-menu">
    <?php
    echo "<ul class='menu-items'>";

    function leftSubMenu($menu, $url) {
        if (!empty($menu)) {
            echo "<ul class='sub-menu'>";
            foreach ($menu as $subMenu) {
                $expandable = !empty($subMenu['content']);
                $active = $subMenu['alias'] === $url ? "active" : "";
                $newtab = '';
                $icon = '';
                if (empty($subMenu['alias']) || $expandable) {
                    $alias = "javascript:;";
                } elseif (strpos($subMenu['alias'], "http") !== false || strpos($subMenu['alias'], "https") !== false) {
                    $alias = $subMenu['alias'];
                    $newtab = 'target="_blank"';
                    $icon = '<i class="fa fa-external-link"></i>';
                } else {
                    $alias = Router::url("/" . $subMenu['alias'], true);
                }
                echo "<li class='m-t-30'><a href='{$alias}' class='' {$newtab}>{$icon} " . __($subMenu['label']);
                if ($expandable) {
                    echo "<span class='arrow'></span>";
                }
                echo "</a><span class='icon-thumbnail'>" . substr(__($subMenu['label']), 0, 1) . "</span>";
                leftSubMenu($subMenu['content'], $url);
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    foreach ($leftSideMenuData as $menu) {
        $expandable = !empty($menu['content']);
        $newtab = '';
        $icon = '';
        if (empty($menu['alias'])) {
            $alias = "javascript:;";
        } elseif (strpos($menu['alias'], "http") !== false || strpos($menu['alias'], "https") !== false) {
            $alias = $menu['alias'];
            $newtab = 'target="_blank"';
            $icon = '<i class="fa fa-external-link"></i>';
        } else {
            $alias = Router::url("/" . $menu['alias'], true);
        }
        ?>
        <li>
            <a href="<?= $alias ?>" class="" <?= $newtab ?>>
                <span class="title"><?= $menu['label'] ?></span>
                <?php
                if ($expandable) {
                    echo "<span class='arrow'></span>";
                }
                ?>
            </a>
            <span class="icon-thumbnail "><i class="<?= $menu['icon'] ?>"></i></span>
            <?php
            $tester = preg_replace("/-add|-edit(.)*/", "", $url);
            leftSubMenu($menu['content'], $tester);
            ?>
        </li>
        <?php
    }
    echo "</ul>";
    ?>
    <div class="clearfix"></div>
</div>
<!-- END SIDEBAR MENU -->