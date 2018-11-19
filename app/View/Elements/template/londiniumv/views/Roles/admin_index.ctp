<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("DATA HAK AKSES") ?>
                <small class="display-block"></small>
            </h6>
        </div>
        <div class="table-responsive pre-scrollable stn-table">
            <form id="checkboxForm" method="post" name="checkboxForm" action="<?php echo Router::url('/' . $this->params['prefix'] . '/' . $this->params['controller'] . '/multiple_delete', true); ?>">
                <table width="100%" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>User Group</th>
                            <th>Menu</th>
                            <th width="100"><?= __("Aksi") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                        $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                        $i = ($limit * $page) - ($limit - 1);
                        if (empty($data['rows'])) {
                            ?>
                            <tr>
                                <td class="text-center" colspan="4">Tidak Ada Data</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($data['rows'] as $item) {
                                $user_group_id = $item["UserGroup"]["id"];
                                ?>
                                <tr id="row-<?= $i ?>">
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?php echo $item['UserGroup']['name']; ?></td>
                                    <td>
                                        <ul>
                                            <?php
                                            foreach ($item['Role'] as $role) {
                                                if ($role['accessible']) {
                                                    echo "<li>";
                                                    echo "{$role['Menu']['label']} [view]" . ($role['add'] ? " [add]" : "") . ($role['edit'] ? " [edit]" : "") . ($role['delete'] ? " [delete]" : "");
                                                    echo "<ul>";
                                                    foreach ($role["Menu"]["SubMenu"] as $subMenu) {
                                                        $currentRoleSubMenu = false;
                                                        foreach ($subMenu["RoleSubMenu"] as $roleSubMenu) {
                                                            if ($roleSubMenu["user_group_id"] == $user_group_id) {
                                                                $currentRoleSubMenu = $roleSubMenu;
                                                            }
                                                        }
                                                        if ($currentRoleSubMenu !== false && $currentRoleSubMenu["accessible"]) {
                                                            echo "<li>";
                                                            echo "{$subMenu['label']} [view]" . ($currentRoleSubMenu['add'] ? " [add]" : "") . ($currentRoleSubMenu['edit'] ? " [edit]" : "") . ($currentRoleSubMenu['delete'] ? " [delete]" : "");
                                                            echo "</li>";
                                                        }
                                                    }
                                                    echo "</ul>";
                                                    echo "</li>";
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <?= $this->element(_TEMPLATE_DIR . "/{$template}/roleaccess/edit", ["editUrl" => Router::url("/admin/{$this->params['controller']}/edit/{$item['UserGroup']['id']}")]) ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <?php echo $this->element(_TEMPLATE_DIR . "/{$template}/pagination") ?>
</div>
