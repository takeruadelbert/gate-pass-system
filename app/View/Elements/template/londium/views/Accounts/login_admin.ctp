<!-- Login wrapper -->
<div class="login-wrapper">
    <?php
    echo $this->element(_TEMPLATE_DIR."/londium/flash-message");
    echo $this->Form->create("Account", array("action" => "login_admin"));
    ?>
    <div class="popup-header">
        <span class="pull-left"></span>
        <span class="text-semibold">Login <?= _APP_NAME?></span>
        <div class="btn-group pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
            <ul class="dropdown-menu icons-right dropdown-menu-right">
                <li><a href="#"><i class="icon-info"></i> Forgot password?</a></li>
            </ul>
        </div>
    </div>
    <div class="well">
        <div class="form-group has-feedback">
            <label>Username</label>
            <?php
            echo $this->Form->input("username", array("class" => "form-control", "div" => false, "label" => false));
            ?>
            <i class="icon-users form-control-feedback"></i>
        </div>

        <div class="form-group has-feedback">
            <label>Password</label>
            <?php
            echo $this->Form->input("password", array("class" => "form-control", "div" => false, "label" => false));
            ?>
            <i class="icon-lock form-control-feedback"></i>
        </div>

        <div class="row form-actions">
            <div class="col-xs-6">
            </div>

            <div class="col-xs-6">
                <button type="submit" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>  
<!-- /login wrapper -->