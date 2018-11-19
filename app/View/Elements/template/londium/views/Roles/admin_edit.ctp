<?php echo $this->Form->create("Role", array("class" => "form-horizontal", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Data Hak Akses") ?></h6>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("UserGroup.name", __("User Group"), array("class" => "col-sm-2 control-label"));
                    echo $this->Form->input("UserGroup.name", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control", "disabled" => true));
                    ?>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Modul</th>
                                    <th width="50">Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($dataModule as $item) {
                                    $i++;
                                    if (!empty($item['Role'])) {
                                        $chk = 'checked';
                                    } else {
                                        $chk = null;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $i?></td>
                                        <td><?php echo $item['Module']['name']; ?></td>
                                        <td>
                                            <label class="checkbox-inline checkbox-success">
                                                <input type="checkbox" class="styled" name="data[Module][id][]" value="<?php echo $item['Module']['id']; ?>" <?php echo $chk; ?>>
                                            </label>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-actions text-right">
                    <button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)"><?= __("Kembali") ?></button>
                    <button type="submit" class="btn btn-info" id="formButton"><?= __("Simpan") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<?php
echo $this->element(_TEMPLATE_DIR . "/londium/form-submit");
?>