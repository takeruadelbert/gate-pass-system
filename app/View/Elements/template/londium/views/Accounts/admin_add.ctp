<?php echo $this->Form->create("Account", array("class" => "form-horizontal", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Data Login") ?></h6>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("User.username", __("Username"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("User.username", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("User.email", __("Email"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("User.email", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("User.user_group_id", __("User Group"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("User.user_group_id", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control", "empty" => "- Pilih Posisi -"));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("User.password", __("Password"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input(null, array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control", "disabled" => true, "value" => "istana123", "type" => "text"));
                    echo $this->Form->input("User.password", array("div" => false, "label" => false, "class" => "form-control", "value" => "password123", "type" => "hidden"));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Data Diri") ?></h6>
    </div>
    <div class="panel-body">
        <div class="row">       
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.first_name", __("Nama Depan"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.first_name", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.last_name", __("Nama Belakang"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.last_name", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">       
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.identity_type_id", __("Jenis Identitas"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.identity_type_id", array("empty" => "- Pilih Jenis Identitas -", "div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.identity_number", __("Nomor Identitas"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.identity_number", array("type" => "text", "div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>        
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.gender_id", __("Jenis Kelamin"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.gender_id", array("empty" => "- Pilih Jenis Kelamin -", "div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.birth_date", __("Tanggal Lahir"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.birth_date", array("type" => "text", "div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control date"));
                    ?>
                </div>
            </div>     
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.country_id", __("Negara"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.country_id", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>

            </div>    
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.state_id", __("Provinsi"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.state_id", array("empty" => "- Pilih Provinsi -", "div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>

            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.city_id", __("Kota"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.city_id", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control","empty"=>"- Pilih Kota -"));
                    ?>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.address", __("Alamat"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.address", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>    
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.postal_code", __("Kode Pos"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.postal_code", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->label("Biodata.handphone", __("Nomor Handphone"), array("class" => "col-sm-4 control-label"));
                    echo $this->Form->input("Biodata.handphone", array("div" => array("class" => "col-sm-6"), "label" => false, "class" => "form-control"));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->input("Account.account_status_id", array("type" => "hidden", "div" => false, "label" => false, "class" => "form-control", "value" => "1"));
?>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-primary" id="formButton"><?= __("Simpan") ?></button>
</div>
<?php echo $this->Form->end() ?>
<?php
echo $this->element(_TEMPLATE_DIR . "/londium/form-submit");
?>