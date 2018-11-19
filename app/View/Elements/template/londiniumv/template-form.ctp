<?php echo $this->Form->create("NamaModel", array("class" => "form-horizontal", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Detail") ?></h6>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("fields", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("fields", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("fields", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-3 control-label"));
                    echo $this->Form->input("fields", array("div" => array("class" => "col-sm-9"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-3 control-label"));
                    echo $this->Form->input("fields", array("div" => array("class" => "col-sm-9"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-3 control-label"));
                    echo $this->Form->input("fields", array("div" => array("class" => "col-sm-9"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-3 control-label"));
                    echo $this->Form->input("fields", array("div" => array("class" => "col-sm-9"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("fields", __("Fields"), array("class" => "col-sm-3 control-label"));
                    echo $this->Form->input("fields", array("div" => array("class" => "col-sm-9"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-actions text-right">
            <button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)"><?= __("Kembali") ?></button>
            <button type="submit" class="btn btn-info" id="formButton"><?= __("Simpan") ?></button>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<?php
echo $this->element(_TEMPLATE_DIR."/londium/form-submit");
?>