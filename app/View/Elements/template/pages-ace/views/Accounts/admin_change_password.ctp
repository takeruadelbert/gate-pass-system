<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->Form->create("Account", array("class" => "", "action" => "change_password", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Data Login") ?></h6>
                </div>
                <div class="panel-body">
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("password_lama", __("Password Lama"), array("class" => ""));
                        echo $this->Form->input("password_lama", array("type" => "password", "div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("User.password", __("Password Baru"), array("class" => ""));
                        echo $this->Form->input("User.password", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("User.repeat_password", __("Ulangi Password Baru"), array("class" => ""));
                        echo $this->Form->input("User.repeat_password", array("type" => "password", "div" => false, "label" => false, "class" => "form-control"));
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
<?php
echo $this->element(_TEMPLATE_DIR."/londium/form-submit");
?>