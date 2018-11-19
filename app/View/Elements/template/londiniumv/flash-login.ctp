<div id="flash-block">
    <?= $this->Session->flash("warninglogin",array("element"=>_TEMPLATE_DIR."/{$template}/flash/login/warninglogin")); ?>
    <?= $this->Session->flash("warninglupapassword",array("element"=>_TEMPLATE_DIR."/{$template}/flash/login/warninglupapassword")); ?>
    <?= $this->Session->flash("successlupapassword",array("element"=>_TEMPLATE_DIR."/{$template}/flash/login/successlupapassword")); ?>
    <?= $this->Session->flash("successlogin",array("element"=>_TEMPLATE_DIR."/{$template}/flash/login/successlogin")); ?>
</div>