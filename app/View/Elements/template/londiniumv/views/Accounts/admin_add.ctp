<?php echo $this->Form->create("Account", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("Tambah Pengguna") ?>
            </h6>
        </div>
        <div class="table-responsive">
            <table width="100%" class="table">
                <div class="panel-heading" style="background:#2179cc">
                    <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Login") ?></h6>
                </div>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("User.username", __("Username"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("User.username", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("User.email", __("Email"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("User.email", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("User.user_group_id", __("User Group"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("User.user_group_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", "empty" => "- Pilih Posisi -"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("User.password", __("Password"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input(null, array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control", "disabled" => true, "value" => "password123", "type" => "text"));
                                    echo $this->Form->input("User.password", array("div" => false, "label" => false, "class" => "form-control", "value" => "password123", "type" => "hidden"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table width="100%" class="table">
                <div class="panel-heading" style="background:#2179cc">
                    <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Login") ?></h6>
                </div>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.first_name", __("Nama Depan"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.first_name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.last_name", __("Nama Belakang"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.last_name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.identity_type_id", __("Jenis Identitas"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.identity_type_id", array("empty" => "- Pilih Jenis Identitas -", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.identity_number", __("Nomor Identitas"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.identity_number", array("type" => "text", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.gender_id", __("Jenis Kelamin"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.gender_id", array("empty" => "- Pilih Jenis Kelamin -", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.birth_date", __("Tanggal Lahir"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.birth_date", array("type" => "text", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control date"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.country_id", __("Negara"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.country_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.state_id", __("Provinsi"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.state_id", array("data-autolist-emptylabel"=>"-Pilih Kota-","data-autolist-target"=>"#BiodataCityId","data-autolist-url"=>Router::url("/admin/cities/list_by_state/",true),"empty" => "- Pilih Provinsi -", "div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full autolist"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.city_id", __("Kota"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.city_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", "empty" => "- Pilih Kota -"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.address", __("Alamat"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.address", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:200px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.postal_code", __("Kode Pos"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.postal_code", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("Biodata.handphone", __("Nomor Handphone"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("Biodata.handphone", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="width:200px">
                        <div class="panel-body">
                            <div class="block-inner text-danger">
                                <div class="form-actions text-right">
                                    <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                                    <input type="reset" value="Reset" class="btn btn-info">
                                    <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
echo $this->Form->input("Account.account_status_id", array("type" => "hidden", "div" => false, "label" => false, "class" => "form-control", "value" => "1"));
?>
<?php echo $this->Form->end() ?>