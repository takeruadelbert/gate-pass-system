<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Member") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Member") ?></h6>
                        </div>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Member.uid", __("UID"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Member.uid", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Member.name", __("Nama"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Member.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Member.expired_dt", __("Expired Date"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Member.expired_dt", array("type" => "text", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control datetime"));
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-sm-3 col-md-4 control-label">
                                                <label>Akses Gate</label>
                                            </div>
                                            <div class="col-sm-9 col-md-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" class="styled tooltip" title="Check/Uncheck Semua Gate" name="input-addon-checkbox" id="isCheckAll" onchange="check_all(this, $('#gate'))">
                                                    </span>
                                                    <?= $this->Form->input("MemberDetail..gate_type_id", array("div" => false, "label" => false, "class" => "select-multiple", 'multiple', 'data-placeholder' => '- Pilih Gate yang diakses -', 'options' => $gateWithTypes, 'id' => 'gate')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-actions text-center">
                                    <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                                    <input type="reset" value="Reset" class="btn btn-info">
                                    <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>

<script>
    var gate_ids = <?= json_encode($gate_ids) ?>;
    function check_all(e, target) {
        if ($(e).is(":checked")) {
            target.select2("val", Object.keys(gate_ids));
        } else {
            target.select2("val", "");
        }
    }

    $(document).keypress(
            function (event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
</script>