<?php echo $this->Form->create("SubMenu", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Sub Menu") ?>
                        <div class="pull-right">
                            <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                            <input type="reset" value="Reset" class="btn btn-info">
                            <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                        </div>
                        <small class="display-block">Form Menu</small>
                    </h6>
                </div>
                <div class="table-responsive">
                    <div class="panel-heading" style="background:#2179cc">
                        <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Sub Menu") ?></h6>
                    </div>
                    <table width="100%" class="table">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.label", __("Label"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.label", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.module_id", __("Modul"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.module_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", "empty" => "Tidak Ada"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.menu_id", __("Menu"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.menu_id", array("div" => array("class" => "col-sm-9 col-md-8"),"data-autolist-target"=>"#SubMenuParentId", "data-autolist-url" => Router::url("/admin/sub_menus/list_by_menu/", true), "data-autolist-emptylabel" => "Tidak Ada", "label" => false, "class" => "select-full autolist", "empty" => "Tidak Ada"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.parent_id", __("Parent"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.parent_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", "empty" => "Tidak Ada", "options" => []));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.ordering_number", __("Urutan"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.ordering_number", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("SubMenu.class_icon", __("Icon"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("SubMenu.class_icon", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>