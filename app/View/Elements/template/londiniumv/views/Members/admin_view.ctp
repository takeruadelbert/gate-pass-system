<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Ubah Data Member") ?>
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table width="100%" class="table">
                            <div class="panel-heading" style="background:#2179cc">
                                <h6 class="panel-title" style=" color:#fff"><i
                                            class="icon-menu2"></i><?= __("Data Member") ?></h6>
                            </div>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->label("Member.name", __("Nama"), array("class" => "col-sm-3 col-md-4 control-label"));
                                                echo $this->Form->input("Member.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control", "disabled"));
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->label("Member.client_id", __("Client"), array("class" => "col-sm-3 col-md-4 control-label"));
                                                echo $this->Form->input("Member.client_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", 'empty' => '', 'placeholder' => '- Pilih Client -', "disabled"));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i
                                        class="icon-menu2"></i><?= __("Data Card") ?></h6>
                        </div>
                        <table width="100%" class="table table-bordered table-hover">
                            <thead>
                            <tr bordercolor="#000000">
                                <td width="1%" align="center" valign="middle" bgcolor="#feffc2">No</td>
                                <td width="20%" align="center" valign="middle" bgcolor="#feffc2">Card</td>
                                <td width="10%" align="center" valign="middle" bgcolor="#feffc2">Expired Date</td>
                                <td width="1%" align="center" valign="middle" bgcolor="#feffc2">Status</td>
                            </tr>
                            </thead>
                            <tbody id="target-memberCard">
                            <?php
                            foreach ($this->data["MemberCard"] as $k => $item) {
                                ?>
                                <tr>
                                    <?= $this->Form->hidden("MemberCard.$k.id") ?>
                                    <td align="center" class="nomorIdx"><?= $k + 1 ?></td>
                                    <td>
                                        <div class="false">
                                            <?= $this->Form->input("MemberCard.$k.card_number", ["div" => false, "class" => "form-control", "label" => false, 'disabled']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="false">
                                            <?= $this->Form->input("MemberCard.$k.expired_dt", ['type' => 'text', 'div' => false, 'class' => 'form-control datepicker', 'label' => false, 'disabled']) ?>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <div class="false">
                                            <?php
                                            $style = $item['status'] === MemberCard::$statusBanned ? "danger" : "success";
                                            ?>
                                            <span class="label label-<?= $style ?>"><?= $item['status'] ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input name="Button" type="button" onclick="history.go(-1);"
                           class="btn btn-success" value="<?= __("Kembali") ?>">
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end() ?>