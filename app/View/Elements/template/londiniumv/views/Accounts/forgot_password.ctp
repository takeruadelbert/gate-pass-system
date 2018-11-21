<!-- Login wrapper -->
<div class="login-wrapper">
    <?php
    echo $this->element(_TEMPLATE_DIR."/londiniumv/flash-message");
    echo $this->Form->create("Account", array("action" => "forgot_password"));
    ?>
    <div class="popup-header">
        <span class="pull-left"></span>
        <span class="text-semibold"><?= __("Forgot Password") ?></span>
        <div class="btn-group pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
            <ul class="dropdown-menu icons-right dropdown-menu-right">
                <li><a href="<?= Router::url("/", true) ?>"><i class="icon-backward2"></i>Back to Login Page</a></li>
            </ul>
        </div>
    </div>
    <div class="well">
        <div class="form-group has-feedback">
            <label>Username</label>
            <?php
            echo $this->Form->input("username", array("class" => "form-control", "div" => false, "label" => false, 'placeholder' => 'your username'));
            ?>
            <i class="icon-users form-control-feedback"></i>
        </div>

        <div class="form-group has-feedback">
            <label>Email</label>
            <?php
            echo $this->Form->input("email", array("class" => "form-control", "div" => false, "label" => false, "type" => "email", 'placeholder' => 'your email'));
            ?>
            <i class="icon-mail-send form-control-feedback"></i>
        </div>

        <div class="row form-actions">
            <div class="col-xs-6">
            </div>

            <div class="col-xs-6">
                <button type="submit" class="btn btn-warning pull-right"><i class="icon-enter"></i> Submit</button>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>  
<!-- /login wrapper -->