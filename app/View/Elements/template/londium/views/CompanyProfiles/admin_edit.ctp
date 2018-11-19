<?php echo $this->Form->create("CompanyProfile", array("class" => "form-horizontal", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-bubble4"></i><?= __("Deskripsi Produk") ?></h6>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.company_name", __("Nama Perusahaan"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.company_name", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.address", __("Alamat"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.address", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.state_id", __("Provinsi"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.state_id", array("empty" => "- Pilih Provinsi -", "div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.city_id", __("Kota"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.city_id", array("empty" => "- Pilih Kota -", "div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.phone", __("Telepon"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.phone", array("empty" => "- Tidak ada pajak -", "div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label("CompanyProfile.email", __("Email"), array("class" => "col-sm-2 control-label"));
            echo $this->Form->input("CompanyProfile.email", array("div" => array("class" => "col-sm-10"), "label" => false, "class" => "form-control"));
            ?>
        </div>
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-primary" id="formButton"><?= __("Simpan") ?></button>
</div>
<?php echo $this->Form->end() ?>
<?php
echo $this->element(_TEMPLATE_DIR."/londium/form-submit");
?>