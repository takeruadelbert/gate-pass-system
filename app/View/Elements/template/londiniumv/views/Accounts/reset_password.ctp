<!-- Login wrapper -->
<div class="login-wrapper">
    <?php
    echo $this->element(_TEMPLATE_DIR."/londiniumv/flash-message");
    echo $this->Form->create("", array("action" => "reset_password/{$this->params['pass'][0]}"));
    ?>
    <div class="popup-header">
        <span class="text-semibold"><?= __("Reset Password") ?></span>
    </div>
    <div class="well">
        <div class="form-group has-feedback">
            <label>Password</label>
            <?php
            echo $this->Form->input("User.password", array("class" => "form-control", "div" => false, "label" => false, 'placeholder' => 'your new password', 'type' => 'password'));
            ?>
            <i class="icon-lock form-control-feedback"></i>
        </div>

        <div class="form-group has-feedback">
            <label>Repeat Password</label>
            <?php
            echo $this->Form->input("User.repeat_password", array("class" => "form-control", "div" => false, "label" => false, "type" => "password", 'placeholder' => 'repeat password to confirm'));
            ?>
            <i class="icon-lock form-control-feedback"></i>
        </div>

        <div class="row form-actions">
            <div class="col-xs-6">
            </div>

            <div class="col-xs-6">
                <button type="submit" class="btn btn-warning pull-right"><i class="icon-enter"></i> Change</button>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>
<style>
    .error-message{
        font-size:9px;
        color:red;
    }
</style>
<!-- /login wrapper -->