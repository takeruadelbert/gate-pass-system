<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "sync_data_member_gate/{$this->params->pass[0]}", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<?= $this->Form->input("Member.gate_id", ['value' => $this->params->pass[0], 'type' => 'hidden']); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger text-center">
                    <h6 class="heading-hr"><?= __("Sync Data Member Lokal <> {$dataRaspi}") ?>
                    </h6>
                </div>
                <!-- Left box -->
                <div class="left-box">                    
                    <input type="text" id="box1Filter" class="form-control" placeholder="Filter Data Lokal ...">
                    <button type="button" id="box1Clear" class="filter">x</button>
                    <select id="box1View" multiple="multiple" class="form-control" name="data[Local][]">
                        <?php
                        if (!empty($dataLocal)) {
                            foreach ($dataLocal as $member_id => $local) {
                                $color = $local['is_diff'] ? "red" : "";
                                ?>
                                <option value="<?= $local['data'] ?>" style="background-color:<?= $color ?>;"><?= $local['data'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>                    
                    <span id="box1Counter" class="count-label"></span>
                    <select id="box1Storage"></select>
                    <span class="help-block">Format Data : ID -- UID -- Nama -- Expired Date </span>
                </div>
                <!-- /left-box -->

                <!-- Control buttons -->
                <div class="dual-control">
                    <button id="to2" type="button" class="btn btn-default">&nbsp;&gt;&nbsp;</button>
                    <button id="allTo2" type="button" class="btn btn-default">&nbsp;&gt;&gt;&nbsp;</button><br />
                    <button id="to1" type="button" class="btn btn-default">&nbsp;&lt;&nbsp;</button>
                    <button id="allTo1" type="button" class="btn btn-default">&nbsp;&lt;&lt;&nbsp;</button>
                </div>
                <!-- /control buttons -->

                <!-- Right box -->
                <div class="right-box">
                    <input type="text" id="box2Filter" class="form-control" placeholder="Filter Data <?= $dataRaspi ?> ...">
                    <button type="button" id="box2Clear" class="filter">x</button>
                    <select id="box2View" multiple="multiple" class="form-control" name="data[RPI][]">
                        <?php
                        if (!empty($dataRPI)) {
                            foreach ($dataRPI as $member_id => $rpi) {
                                $color = $rpi['is_diff'] ? "red" : "";
                                ?>
                                <option value="<?= $rpi['data'] ?>" style="background-color:<?= $color ?>;"><?= $rpi['data'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <span id="box2Counter" class="count-label"></span>
                    <select id="box2Storage"></select>
                    <span class="help-block">Format Data : ID -- UID -- Nama -- Expired Date </span>
                </div>
                <!-- /right box -->             
            </div>
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                <input type="reset" value="Reset" class="btn btn-info">
                <input name="Button" type="button" class="btn btn-danger" value="<?= __("Simpan") ?>" id="save">
            </div><br>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>

<script>
    $(document).ready(function () {
        $("#save").click(function () {
            $("#box2View option").each(function() {
                $(this).attr("disabled", "disabled");
            });
            $("option[style='background-color:red;']").each(function () {
                $(this).removeAttr("disabled");
                $(this).prop("selected", true);
            });
            $("#formSubmit").submit();
        });
    });

</script>