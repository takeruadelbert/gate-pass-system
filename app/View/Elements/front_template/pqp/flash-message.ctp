<div id="flash-block">
    <?= $this->Session->flash("danger",array("element"=>"front_template/{$frontTemplate}/flash/danger")); ?>
    <?= $this->Session->flash("success",array("element"=>"front_template/{$frontTemplate}/flash/success")); ?>
</div>