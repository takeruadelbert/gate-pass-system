<div class="col-md-12 col-sm-12 col-xs-12 content-middle">
    <div class="col-md-12 col-sm-12 col-xs-12 form">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 changed-content active" id="changedContent1">
                <?php
                echo $this->Form->create();
                ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group label-floating">
                            <div class="input-group font-Roboboto">
                                <span class="input-group-addon box-imgPassword"><img src="<?= Router::url("/" . _TEMPLATE_DIR . DS . $template . DS . "login/img/lock.png", true) ?>"></span>
                                <label class="control-label label-edit" for="newPassword"><?= __("Kata Sandi") ?></label>
                                <?= $this->Form->input('User.password', ['class' => 'form-control input-username', 'label' => false, 'div' => false]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group label-floating">
                            <div class="input-group font-Roboboto">
                                <span class="input-group-addon box-imgPassword"><img src="<?= Router::url("/" . _TEMPLATE_DIR . DS . $template . DS . "login/img/lock.png", true) ?>"></span>
                                <label class="control-label label-edit" for="repeatPassword"><?= __("Ulangi Kata Sandi") ?></label>
                                <?= $this->Form->input('User.repeat_password', ['class' => 'form-control input-username', 'label' => false, 'div' => false,"type"=>"password"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                echo $this->element(_TEMPLATE_DIR . "/londiniumv/flash-login");
                ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 btn-div">
                        <button class="btn font-sourceSansProBold changed-button active" ><?= __("Ganti") ?></button>
                    </div>
                </div>
                <?php
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<style>
    .error-message{
        font-size:9px;
        color:red;
    }
</style>