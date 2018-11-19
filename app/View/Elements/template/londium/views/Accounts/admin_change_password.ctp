<?php echo $this->Form->create("Account", array("class" => "form-horizontal", "action" => "change_password", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Data Login") ?></h6>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label("password_lama", __("Password Lama"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("password_lama", array("type" => "password", "div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("User.password", __("Password Baru"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("User.password", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("User.repeat_password", __("Ulangi Password Baru"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("User.repeat_password", array("type" => "password", "div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-primary" id="formButton"><?= __("Simpan") ?></button>
</div>
<?php echo $this->Form->end() ?>
<?php
echo $this->element(_TEMPLATE_DIR."/londium/form-submit");
?>