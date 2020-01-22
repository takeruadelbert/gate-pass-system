<?php echo $this->Form->create("Client", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Ubah Client") ?>
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table width="100%" class="table">
                            <div class="panel-heading" style="background:#2179cc">
                                <h6 class="panel-title" style=" color:#fff"><i
                                            class="icon-menu2"></i><?= __("Data Client") ?></h6>
                            </div>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->label("Client.name", __("Nama"), array("class" => "col-sm-3 col-md-4 control-label"));
                                                echo $this->Form->input("Client.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->label("Client.gate", __("Gate"), array("class" => 'col-sm-3 col-md-4 control-label'));
                                                $selectedGateIds = [];
                                                if (!empty($this->request->data['Gate'])) {
                                                    $selectedGateIds = array_column($this->request->data['Gate'], 'id');
                                                }
                                                ?>
                                                <div class="col-sm-9 col-md-8">
                                                    <select data-placeholder="- Pilih Gate -"
                                                            class="select-multiple" multiple="multiple" tabindex="2"
                                                            name="data[Dummy][][gate_id]" required>
                                                        <?php
                                                        foreach ($gates as $type => $gate) {
                                                            ?>
                                                            <optgroup label="<?= $type ?>">
                                                                <?php
                                                                foreach ($gate as $gate_id => $gate_name) {
                                                                    $isSelected = in_array($gate_id, $selectedGateIds) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?= $gate_id ?>"
                                                                            <?= $isSelected ?>><?= $gate_name ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-actions text-center">
                                        <input name="Button" type="button" onclick="history.go(-1);"
                                               class="btn btn-success" value="<?= __("Kembali") ?>">
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