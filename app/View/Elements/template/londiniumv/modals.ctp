<div class="modal fade" id="multipledelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<div id="default-modalpenilaian" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<div id="modalgantipp" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg-4">
        <div class="modal-content">
            <?php echo $this->Form->create("Account", array("type"=>"file","action" => "ganti_pp", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= __("Ganti Foto") ?></h4>
            </div>
            <div class="modal-body">
                <br/>
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-4 control-label">
                                <label>Foto</label>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->input("profile_picture", ["type" => "file", "accept" => "image/*", "label" => false, "div" => false]) ?>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= __("Batal") ?></button>
                <button type="submot" class="btn btn-success"><?= __("Ganti") ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<style>
    #multipledelete .modal-dialog{
        top:200px;
        width:350px;
    }
</style>