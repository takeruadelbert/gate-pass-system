<?php echo $this->Form->create("History", array("class" => "form-horizontal form-separate", "action" => "read_data_history", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Read Data History Device
                        </h6>
                    </div>
                    <div class="col-sm-3 col-md-3">

                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="table-responsive stn-table">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        echo $this->Form->label("History.gate_id", __("Gate"), array("class" => "col-sm-3 col-md-4 control-label"));
                                        echo $this->Form->input("History.gate_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", 'empty' => '', 'placeholder' => '- Pilih Gate -'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">

                    </div>
                </div>
            </div>
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);"
                       class="btn btn-success" value="<?= __("Kembali") ?>">
                <input type="submit" value="<?= __("Lanjut") ?>" class="btn btn-danger">
            </div>
            <br>
        </div>
    </div>
<?php echo $this->Form->end() ?>