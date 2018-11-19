<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->Form->create("ModuleContent", array("class" => "", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Detail") ?></h6>
                </div>
                <div class="panel-body">
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("name", __("Label"), array());
                        echo $this->Form->input("name", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("alias", __("Alias"), array("class" => ""));
                        echo $this->Form->input("alias", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default form-group-default-select2">
                        <?php
                        echo $this->Form->label("module_id", __("Modul"), array("class" => ""));
                        echo $this->Form->input("module_id", array("div" => false, "label" => false, "class" => "full-width", "empty" => "- Pilih Modul -", "data-init-plugin" => "select2"));
                        ?>
                    </div>
                    <div class="form-group form-group-default form-group-default-select2">
                        <?php
                        echo $this->Form->label("parent_id", __("Parent"), array("class" => ""));
                        echo $this->Form->input("parent_id", array("div" => false, "label" => false, "class" => "full-width", "empty" => "- Pilih Parent -", "data-init-plugin" => "select2"));
                        ?>
                    </div>
                    <div class="form-actions text-right">
                        <button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)"><?= __("Kembali") ?></button>
                        <button type="submit" class="btn btn-info" id="formButton"><?= __("Simpan") ?></button>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $("#ModuleContentModuleId").bind("change", function() {
        getOptions("#ModuleContentParentId", BASE_URL + CONTROLLER + "/parents", "- Pilih Parent -", "#ModuleContentModuleId");
    })
</script>