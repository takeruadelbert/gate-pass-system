<?php echo $this->Form->create("Employee", array("class" => "form-horizontal form-separate", "action" => "view", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="tabbable page-tabs">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#data-utama" data-toggle="tab"><i class="icon-user3"></i> <?= __("Data Utama") ?></a></li>
        <li><a href="#data-login" data-toggle="tab"><?= __("Login") ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active fade in" id="data-utama">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Data Utama") ?>
                        </h6>
                    </div>
                    <div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Employee.nip", __("NIP"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Employee.nip", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            echo $this->Form->label("Employee.department_id", __("Bidang"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Employee.department_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control", "empty" => "- Pilih Bidang -"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.first_name", __("Nama Depan"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.first_name", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.last_name", __("Nama Belakang"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.last_name", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.gelar_depan", __("Gelar Depan"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.gelar_depan", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.gelar_belakang", __("Gelar Belakang"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.gelar_belakang", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.tempat_lahir_provinsi", __("Provinsi Tempat Lahir"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.tempat_lahir_provinsi", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.tempat_lahir_kota", __("Kab./Kota Tempat Lahir"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.tempat_lahir_kota", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.tanggal_lahir", __("Tanggal Lahir"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.tanggal_lahir", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control datepicker", "type" => "text"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.religion_id", __("Agama"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.religion_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control", "empty" => "- Pilih Agama -"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.gender_id", __("Jenis Kelamin"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.gender_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control", "empty" => "- Pilih Jenis Kelamin -"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.User.email", __("Email"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.User.email", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.address", __("Alamat"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.address", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.postal_code", __("Kode Pos"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.postal_code", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.state_id", __("Provinsi"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.state_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control city-state", "data-city-state-target" => ".city-state-target", "empty" => "- Pilih Provinsi -"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.city_id", __("Kota"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.city_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control city-state-target", "empty" => "- Pilih Kota -"));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.Biodata.handphone", __("No. HP"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.handphone", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control", "empty" => "- Pilih Provinsi -"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.Biodata.phone", __("No. Telp"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.Biodata.phone", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade in" id="data-login">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Data Login") ?>
                        </h6>
                    </div>
                    <div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label("Account.User.username", __("Username"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.User.username", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                            <?php
                            echo $this->Form->label("Account.User.user_group_id", __("User Group"), array("class" => "col-md-2 control-label"));
                            echo $this->Form->input("Account.User.user_group_id", array("div" => array("class" => "col-md-4"), "label" => false, "class" => "form-control"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<style>
    select{
        padding: 11px 50px 11px 10px;
        background: rgba(255,255,255,1);
        border-radius: 7px;
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
        border: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        color: #8ba2d4;
    }
</style>