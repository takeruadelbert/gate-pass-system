<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->Form->create("Bowl", array("class" => "", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Detail") ?></h6>
                </div>
                <div class="panel-body">
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("Bowl.name", __("Nama"), array());
                        echo $this->Form->input("Bowl.name", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("Bowl.paid_time", __("Tanggal Pembayaran"), array("class" => ""));
                        echo $this->Form->input("Bowl.paid_time", array("div" => false, "label" => false, "class" => "form-control pages-date","type"=>"text"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("Fruit.0.name", __("Buah 1"), array("class" => ""));
                        echo $this->Form->input("Fruit.0.name", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-group form-group-default">
                        <?php
                        echo $this->Form->label("Fruit.0.name", __("Buah 2"), array("class" => ""));
                        echo $this->Form->input("Fruit.0.name", array("div" => false, "label" => false, "class" => "form-control"));
                        ?>
                    </div>
                    <div class="form-actions text-right">
                        <button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)"><?= __("Kembali") ?></button>
                        <button type="submit" class="btn btn-info" id="formButton"><?= __("Simpan") ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>