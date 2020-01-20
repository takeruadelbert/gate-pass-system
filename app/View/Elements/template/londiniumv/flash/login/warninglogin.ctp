<div class="col-md-12 col-sm-12 col-xs-12 peringatan">
    <div class="col-md-2 col-sm-2 col-xs-2">
        <img src="<?= Router::url("/" . _TEMPLATE_DIR . DS . $template . DS . "login/img/peringatan.png", true) ?>">
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10 font-sourceSansPro">
        <?= h($message); ?>
    </div>
</div>