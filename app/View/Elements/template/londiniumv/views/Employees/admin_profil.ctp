<?php echo $this->Form->create("Employee", array("class" => "form-horizontal form-separate", "action" => "profil", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
        <div class="block">
            <div class="block">
                <div class="thumbnail">
                    <div class="thumb"><img alt="" src="<?= Router::url('/', true) . $this->Session->read("credential.admin.User.profile_picture") ?>">
                        <div class="thumb-options"><span><a onclick="modalChangepp()" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a></span></div>
                    </div>
                    <div class="caption text-center">
                        <h6><?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata")) ?> <small><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id")) ?></small></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10">
        <div class="panel">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr">PROFIL PEGAWAI
                        <div class="pull-right">
                        </div>
                        <small class="display-block"><?= _APP_CORPORATE ?></small>
                    </h6>
                </div>
                <!-- Justified pills -->
                <div class="well block">
                    <div class="tabbable">
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#justified-pill1" data-toggle="tab"><i class="icon-mail-send"></i> Data Login </a></li>
                            <li class=""><a href="#justified-pill2" data-toggle="tab"><i class="icon-file6"></i> Data Pribadi </a></li>
                        </ul>
                        <div class="tab-content pill-content">
                            <div class="tab-pane fade active in" id="justified-pill1"><table width="100%" class="table table-hover">
                                    <tbody><tr>
                                            <td colspan="11" style="width:200px">
                                                <div class="form-group">
                                                    <?php
                                                    echo $this->Form->label("Account.User.username", __("Username"), array("class" => "col-sm-2 control-label"));
                                                    echo $this->Form->input("Account.User.username", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                    echo $this->Form->input("Account.id", ['type' => "hidden"]);
                                                    echo $this->Form->input("Account.User.id", ['type' => "hidden"]);
                                                    echo $this->Form->input("Account.Biodata.id", ['type' => "hidden"]);
                                                    ?>
                                                    <?php
                                                    echo $this->Form->label("Account.User.email", __("Email"), array("class" => "col-sm-2 control-label"));
                                                    echo $this->Form->input("Account.User.email", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="justified-pill2">
                                <table width="100%" class="table table-hover">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.first_name", __("Nama Depan"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.first_name", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                                <?php
                                                echo $this->Form->label("Account.Biodata.last_name", __("Nama Belakang"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.last_name", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.tempat_lahir_kota", __("Tempat Lahir"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.tempat_lahir_kota", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                                <?php
                                                echo $this->Form->label("Account.Biodata.tanggal_lahir", __("Tanggal Lahir"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.tanggal_lahir", array("div" => array("class" => "col-sm-4"), "label" => false, "type" => "text", "class" => "form-control datepicker"));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.religion_id", __("Agama"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.religion_id", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "select-full", "empty" => "", "placeholder" => "- Pilih Agama -"));
                                                ?>
                                                <?php
                                                echo $this->Form->label("Account.Biodata.gender_id", __("Jenis Kelamin"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.gender_id", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "select-full", "empty" => "", "placeholder" => "- Pilih Jenis Kelamin -"));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.address", __("Alamat"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.address", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                                <?php
                                                echo $this->Form->label("Account.Biodata.postal_code", __("Kode Pos"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.postal_code", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.state_id", __("Provinsi"), array("class" => "col-md-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.state_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "select-full city-state", "data-city-state-target" => "#AccountBiodataCityId", "empty" => "- Pilih Provinsi -"));
                                                ?>
                                                <?php
                                                $dataCity = "";
                                                $city = "";
                                                if (!empty($this->data['Account']['Biodata']['state_id'])) {
                                                    $dataCity = ClassRegistry::init("City")->find("list", [
                                                        "conditions" => [
                                                            "City.state_id" => $this->data['Account']['Biodata']['state_id']
                                                        ],
                                                        'recursive' => -1
                                                    ]);
                                                    if (!empty($this->data['Account']['Biodata']['city_id'])) {
                                                        $city = ClassRegistry::init("City")->find("first", [
                                                            "conditions" => [
                                                                "City.id" => $this->data['Account']['Biodata']['city_id'],
                                                                "City.state_id" => $this->data['Account']['Biodata']['state_id']
                                                            ],
                                                            "recursive" => -1
                                                        ]);
                                                    }
                                                }
                                                echo $this->Form->label("Account.Biodata.city_id", __("Kota"), array("class" => "col-md-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.city_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "select-full city-state-target", "empty" => "- Pilih Kota -", 'options' => $dataCity, 'value' => !empty($city) ? $city['City']['id'] : ""));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Form->label("Account.Biodata.handphone", __("No Handphone"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.handphone", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                                <?php
                                                echo $this->Form->label("Account.Biodata.phone", __("No Telp (Rumah)"), array("class" => "col-sm-2 control-label"));
                                                echo $this->Form->input("Account.Biodata.phone", array("div" => array("class" => "col-sm-4"), "label" => false, "class" => "form-control"));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="block-inner text-danger">
                    <div class="form-actions text-center">
                        <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                        <input type="submit" value="Ubah" class="btn btn-danger">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>