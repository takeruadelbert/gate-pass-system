<?php echo $this->Form->create("Module", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Modul") ?>
                        <div class="pull-right">
                            <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                            <input type="reset" value="Reset" class="btn btn-info">
                            <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                        </div>
                        <small class="display-block">Form Modul</small>
                    </h6>
                </div>
                <div class="table-responsive">
                    <div class="panel-heading" style="background:#2179cc">
                        <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Modul") ?></h6>
                    </div>
                    <table width="100%" class="table">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Module.name", __("Label"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Module.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Module.alias", __("Alias"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Module.alias", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="panel-heading" style="background:#2179cc">
                        <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Modul Link") ?></h6>
                    </div>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>
                            <tr bordercolor="#000000">
                                <td width="1%" align="center" valign="middle" bgcolor="#feffc2">No</td>
                                <td width="20%" align="center" valign="middle" bgcolor="#feffc2">Nama</td>
                                <td align="center" valign="middle" bgcolor="#feffc2">Alias</td>
                                <td width="5%" align="center" valign="middle" bgcolor="#feffc2">Aksi</td>
                            </tr>
                        </thead>
                        <tbody id="target-modullink">
                            <?php
                            foreach ($this->data["ModuleLink"] as $k => $item) {
                                ?>
                                <tr>
                                    <?= $this->Form->hidden("ModuleLink.$k.id") ?>
                                    <td align="center" class="nomorIdx"><?= $k + 1 ?></td>
                                    <td>
                                        <div class="false">
                                            <?= $this->Form->input("ModuleLink.$k.name", [ "div" => false, "class" => "form-control", "label" => false]) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="false">
                                            <?= $this->Form->input("ModuleLink.$k.alias", [ "div" => false, "class" => "form-control", "label" => false]) ?>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(false)" onclick="deleteThisRow($(this))"><i class="icon-remove3"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>  
                        <tfoot>
                            <tr class="addrowborder">
                                <td colspan="4" align="left"><a href="javascript:void(false)" onclick="addThisRow($(this), 'modullink')" data-n="<?= count($this->data["ModuleLink"]) ?>"><i class="icon-plus-circle"></i></a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<script>
    function addThisRow(e, t, optFunc) {
        var n = $(e).data("n");
        var template = $('#tmpl-' + t).html();
        Mustache.parse(template);
        var options = {i: 2, n: n};
        if (typeof (optFunc) !== 'undefined') {
            $.extend(options, window[optFunc]());
        }
        var rendered = Mustache.render(template, options);
        $("#target-" + t).append(rendered);
        $(e).data("n", n + 1);
        fixNumber($(e).parents("table").find("tbody"));
    }
    function fixNumber(e) {
        var i = 1;
        $.each(e.find("tr"), function () {
            $(this).find(".nomorIdx").html(i);
            i++;
        })
    }
    function deleteThisRow(e) {
        var tbody = $(e).parents("tbody");
        var tr = e.parents("tr");
        tr.remove();
        fixNumber(tbody);
    }
</script>

<script type="x-tmpl-mustache" id="tmpl-modullink">
    <tr>
    <td align="center" class="nomorIdx">1</td>
    <td>
    <div class="false">
    <input name="data[ModuleLink][{{n}}][name]" class="form-control" maxlength="255" type="text" id="ModuleLink{{n}}Name">                                        </div>
    </td>
    <td>
    <div class="false">
    <input name="data[ModuleLink][{{n}}][alias]" class="form-control" maxlength="255" type="text" id="ModuleLink{{n}}Alias" required="required">                                        </div>
    </td>
    <td align="center">
    <a href="javascript:void(false)" onclick="deleteThisRow($(this))"><i class="icon-remove3"></i></a>
    </td>
    </tr>
</script>