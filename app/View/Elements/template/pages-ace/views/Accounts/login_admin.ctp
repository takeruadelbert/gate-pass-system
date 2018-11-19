<!-- Login wrapper -->
<div class="">
    <?php
    echo $this->element(_TEMPLATE_DIR."/pages-ace/flash-message");
    echo $this->Form->create("Account", array("action" => "login_admin"));
    ?>
    <div class="">
        <div class="form-group form-group-default">
            <label>Username</label>
            <?php
            echo $this->Form->input("username", array("class" => "form-control", "div" => false, "label" => false));
            ?>
            <i class="icon-users form-control-feedback"></i>
        </div>

        <div class="form-group form-group-default">
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