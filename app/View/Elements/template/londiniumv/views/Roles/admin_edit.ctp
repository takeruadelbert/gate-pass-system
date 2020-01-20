<?php echo $this->Form->create("Role", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Hak Akses") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Ubah Hak Akses") ?></h6>
                        </div>
                        <tr>
                            <td colspan="3" style="width:200px">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("UserGroup.name", __("User Group"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("UserGroup.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control", "disabled" => true));
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="width:200px">
                                <div class="panel panel-default">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="50">#</th>
                                                    <th>Modul</th>
                                                    <th width="50" class="text-center">Akses</th>
                                                    <th width="50" class="text-center">Add</th>
                                                    <th width="50" class="text-center">Edit</th>
                                                    <th width="50" class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $n = 0;
                                                foreach ($dataMenu as $item) {
                                                    $i++;
                                                    if (isset($item['Role'][0]) && $item['Role'][0]['accessible']) {
                                                        $accessible = 'checked';
                                                        $accessibleDisabled = "disabled";
                                                    } else {
                                                        $accessible = null;
                                                        $accessibleDisabled = null;
                                                    }
                                                    if (isset($item['Role'][0]) && $item['Role'][0]['add']) {
                                                        $add = 'checked';
                                                        $addDisabled = "disabled";
                                                    } else {
                                                        $add = null;
                                                        $addDisabled = null;
                                                    }
                                                    if (isset($item['Role'][0]) && $item['Role'][0]['edit']) {
                                                        $edit = 'checked';
                                                        $editDisabled = "disabled";
                                                    } else {
                                                        $edit = null;
                                                        $editDisabled = null;
                                                    }
                                                    if (isset($item['Role'][0]) && $item['Role'][0]['delete']) {
                                                        $delete = 'checked';
                                                        $deleteDisabled = "disabled";
                                                    } else {
                                                        $delete = null;
                                                        $deleteDisabled = null;
                                                    }
                                                    if (isset($item['Role'][0])) {
                                                        ?>
                                                    <input type="hidden" name="data[Role][<?= $i ?>][id]" value="<?= $item['Role'][0]['id'] ?>"/>
                                                    <?php
                                                }
                                                ?>
                                                <input type="hidden" name="data[Role][<?= $i ?>][menu_id]" value="<?= $item['Menu']['id'] ?>"/>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?php echo $item['Menu']['label']; ?></td>
                                                    <td class="text-center">
                                                        <label class="checkbox-inline checkbox-success toggledisabled">
                                                            <input type="checkbox" class="styled togglecon" name="data[Role][<?= $i ?>][accessible]" value="1" <?php echo $accessible; ?>>
                                                            <input type="hidden" name="data[Role][<?= $i ?>][accessible]" value="0" <?php echo $accessibleDisabled; ?>/>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox-inline checkbox-success toggledisabled">
                                                            <input type="checkbox" class="styled togglecon" name="data[Role][<?= $i ?>][add]" value="1" <?php echo $add; ?>>
                                                            <input type="hidden" name="data[Role][<?= $i ?>][add]" value="0" <?php echo $addDisabled; ?>/>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox-inline checkbox-success toggledisabled">
                                                            <input type="checkbox" class="styled togglecon" name="data[Role][<?= $i ?>][edit]" value="1" <?php echo $edit; ?>>
                                                            <input type="hidden" name="data[Role][<?= $i ?>][edit]" value="0" <?php echo $editDisabled; ?>/>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox-inline checkbox-success toggledisabled">
                                                            <input type="checkbox" class="styled togglecon" name="data[Role][<?= $i ?>][delete]" value="1" <?php echo $delete; ?>>
                                                            <input type="hidden" name="data[Role][<?= $i ?>][delete]" value="0" <?php echo $deleteDisabled; ?>/>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <?php
                                                foreach ($item["SubMenu"] as $j => $subMenu) {
                                                    $n++;
                                                    if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['accessible']) {
                                                        $accessibleSubMenu = 'checked';
                                                        $accessibleSubMenuDisabled = "disabled";
                                                    } else {
                                                        $accessibleSubMenu = null;
                                                        $accessibleSubMenuDisabled = null;
                                                    }
                                                    if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['add']) {
                                                        $addSubMenu = 'checked';
                                                        $addSubMenuDisabled = "disabled";
                                                    } else {
                                                        $addSubMenu = null;
                                                        $addSubMenuDisabled = null;
                                                    }
                                                    if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['edit']) {
                                                        $editSubMenu = 'checked';
                                                        $editSubMenuDisabled = "disabled";
                                                    } else {
                                                        $editSubMenu = null;
                                                        $editSubMenuDisabled = null;
                                                    }
                                                    if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['delete']) {
                                                        $deleteSubMenu = 'checked';
                                                        $deleteSubMenuDisabled = "disabled";
                                                    } else {
                                                        $deleteSubMenu = null;
                                                        $deleteSubMenuDisabled = null;
                                                    }
                                                    if (isset($subMenu['RoleSubMenu'][0])) {
                                                        ?>
                                                        <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][id]" value="<?= $subMenu['RoleSubMenu'][0]['id'] ?>"/>
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][sub_menu_id]" value="<?= $subMenu['id'] ?>"/>
                                                    <tr>
                                                        <td><?= $i . "." . ($j + 1) ?></td>
                                                        <td><?= $subMenu['label']; ?></td>
                                                        <td class="text-center">
                                                            <label class="checkbox-inline checkbox-success toggledisabled">
                                                                <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][accessible]" value="1" <?php echo $accessibleSubMenu; ?>>
                                                                <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][accessible]" value="0" <?php echo $accessibleSubMenuDisabled; ?>/>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">
                                                            <label class="checkbox-inline checkbox-success toggledisabled">
                                                                <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][add]" value="1" <?php echo $addSubMenu; ?>>
                                                                <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][add]" value="0" <?php echo $addSubMenuDisabled; ?>/>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">
                                                            <label class="checkbox-inline checkbox-success toggledisabled">
                                                                <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][edit]" value="1" <?php echo $editSubMenu; ?>>
                                                                <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][edit]" value="0" <?php echo $editSubMenuDisabled; ?>/>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">
                                                            <label class="checkbox-inline checkbox-success toggledisabled">
                                                                <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][delete]" value="1" <?php echo $deleteSubMenu; ?>>
                                                                <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][delete]" value="0" <?php echo $deleteSubMenuDisabled; ?>/>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    _subMenu($subMenu["Children"], $n, $i . "." . ($j + 1));
                                                }
                                                ?>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <div class="form-actions text-center">
                        <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                        <input type="reset" value="Reset" class="btn btn-info">
                        <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<script>
    $(document).ready(function () {
        $(".toggledisabled").on("click", function () {
            if ($(this).find(".togglecon").is(':checked')) {
                $(this).find("input[type=hidden]").attr("disabled", "disabled");
            } else {
                $(this).find("input[type=hidden]").removeAttr("disabled");
            }
        })
    })
</script>
<?php

function _subMenu($subMenus = [], &$n, $parentNum = "") {
    foreach ($subMenus as $k => $subMenu) {
        $n++;
        if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['accessible']) {
            $accessibleSubMenu = 'checked';
            $accessibleSubMenuDisabled = "disabled";
        } else {
            $accessibleSubMenu = null;
            $accessibleSubMenuDisabled = null;
        }
        if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['add']) {
            $addSubMenu = 'checked';
            $addSubMenuDisabled = "disabled";
        } else {
            $addSubMenu = null;
            $addSubMenuDisabled = null;
        }
        if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['edit']) {
            $editSubMenu = 'checked';
            $editSubMenuDisabled = "disabled";
        } else {
            $editSubMenu = null;
            $editSubMenuDisabled = null;
        }
        if (isset($subMenu['RoleSubMenu'][0]) && $subMenu['RoleSubMenu'][0]['delete']) {
            $deleteSubMenu = 'checked';
            $deleteSubMenuDisabled = "disabled";
        } else {
            $deleteSubMenu = null;
            $deleteSubMenuDisabled = null;
        }
        if (isset($subMenu['RoleSubMenu'][0])) {
            ?>
            <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][id]" value="<?= $subMenu['RoleSubMenu'][0]['id'] ?>"/>
            <?php
        }
        ?>
        <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][sub_menu_id]" value="<?= $subMenu["SubMenu"]['id'] ?>"/>
        <tr>
            <td><?= $parentNum . "." . ($k + 1) ?></td>
            <td><?= $subMenu["SubMenu"]['label']; ?></td>
            <td class="text-center">
                <label class="checkbox-inline checkbox-success toggledisabled">
                    <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][accessible]" value="1" <?php echo $accessibleSubMenu; ?>>
                    <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][accessible]" value="0" <?php echo $accessibleSubMenuDisabled; ?>/>
                </label>
            </td>
            <td class="text-center">
                <label class="checkbox-inline checkbox-success toggledisabled">
                    <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][add]" value="1" <?php echo $addSubMenu; ?>>
                    <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][add]" value="0" <?php echo $addSubMenuDisabled; ?>/>
                </label>
            </td>
            <td class="text-center">
                <label class="checkbox-inline checkbox-success toggledisabled">
                    <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][edit]" value="1" <?php echo $editSubMenu; ?>>
                    <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][edit]" value="0" <?php echo $editSubMenuDisabled; ?>/>
                </label>
            </td>
            <td class="text-center">
                <label class="checkbox-inline checkbox-success toggledisabled">
                    <input type="checkbox" class="styled togglecon" name="data[RoleSubMenu][<?= $n ?>][delete]" value="1" <?php echo $deleteSubMenu; ?>>
                    <input type="hidden" name="data[RoleSubMenu][<?= $n ?>][delete]" value="0" <?php echo $deleteSubMenuDisabled; ?>/>
                </label>
            </td>
        </tr>
        <?php
        _subMenu($subMenu["Children"], $n, $parentNum . "." . ($k + 1));
    }
}
?>