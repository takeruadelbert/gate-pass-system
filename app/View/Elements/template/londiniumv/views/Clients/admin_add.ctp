<?php echo $this->Form->create("Client", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Client") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Client") ?></h6>
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
                                            ?>
                                            <div class="col-sm-9 col-md-8">
                                                <select data-placeholder="Your Favorite Football Team" class="select-multiple" multiple="multiple" tabindex="2">
                                                    <optgroup label="NFC EAST">
                                                        <option>Dallas Cowboys</option>
                                                        <option selected="selected">New York Giants</option>
                                                        <option>Philadelphia Eagles</option>
                                                        <option>Washington Redskins</option>
                                                    </optgroup>
                                                    <optgroup label="NFC NORTH">
                                                        <option selected="selected">Chicago Bears</option>
                                                        <option>Detroit Lions</option>
                                                        <option>Green Bay Packers</option>
                                                        <option>Minnesota Vikings</option>
                                                    </optgroup>
                                                    <optgroup label="NFC SOUTH">
                                                        <option selected="selected">Atlanta Falcons</option>
                                                        <option>Carolina Panthers</option>
                                                        <option>New Orleans Saints</option>
                                                        <option>Tampa Bay Buccaneers</option>
                                                    </optgroup>
                                                    <optgroup label="NFC WEST">
                                                        <option>Arizona Cardinals</option>
                                                        <option>St. Louis Rams</option>
                                                        <option>San Francisco 49ers</option>
                                                        <option>Seattle Seahawks</option>
                                                    </optgroup>
                                                    <optgroup label="AFC EAST">
                                                        <option>Buffalo Bills</option>
                                                        <option>Miami Dolphins</option>
                                                        <option>New England Patriots</option>
                                                        <option>New York Jets</option>
                                                    </optgroup>
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