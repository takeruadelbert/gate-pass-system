<div id="flash-block">
    <?= $this->Session->flash("danger",array("element"=>_TEMPLATE_DIR."/{$template}/flash/danger")); ?>
    <?= $this->Session->flash("success",array("element"=>_TEMPLATE_DIR."/{$template}/flash/success")); ?>
    <?= $this->Session->flash("warning",array("element"=>_TEMPLATE_DIR."/{$template}/flash/warning")); ?>
    <?= $this->Session->flash("info",array("element"=>_TEMPLATE_DIR."/{$template}/flash/info")); ?>
</div>