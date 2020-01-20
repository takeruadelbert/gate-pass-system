<?php echo $this->Form->create("EntityConfiguration", array("class" => "form-horizontal form-separate", "type" => "file", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="tabbable page-tabs">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#profil" data-toggle="tab"><i class="icon-envelop"></i> <?= __("Profil") ?></a></li>
        <li><a href="#kop" data-toggle="tab"><i class="icon-users"></i> <?= __("Header Kop") ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active fade in" id="profil">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Profil") ?>
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("name", __("Nama Instansi"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("shortname", __("Akronim"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("shortname", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("address", __("Alamat"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("address", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("telp", __("Telpon"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("telp", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("email", __("Email"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("email", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->label("web", __("Web"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("web", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade in" id="kop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?= __("Header KOP") ?>
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <div class="form-group">
                            <?php
                            echo $this->Form->input("header", array("div" => array("class" => ""), "label" => false, "class" => "form-control ckeditor-fix"));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                echo $this->Form->label("logo1", __("Logo Kop"), array("class" => "col-sm-3 col-md-4 control-label"));
                                ?>
                                <div class="col-sm-9 col-md-8">
                                    <img src="<?= Router::url($this->data['EntityConfiguration']['logo1'])?>" alt="Tidak ada logo"/>
                                    <?php
                                    echo $this->Form->input("filelogo1", array("div" => false, "label" => false, "class" => "form-control", "type" => "file","accept"=>"image/*"));
                                    ?>
                                </div>
                            </div>
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
                <input type="reset" value="Reset" class="btn btn-info">
                <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>