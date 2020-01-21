<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "multi_add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Member") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Gate") ?></h6>
                        </div>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-sm-3 col-md-4 control-label">
                                                <label>Akses Gate</label>
                                            </div>
                                            <div class="col-sm-9 col-md-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" class="styled tooltip" title="Check/Uncheck Semua Gate" name="input-addon-checkbox" id="isCheckAll" onchange="check_all(this, $('#gate'))">
                                                    </span>
                                                    <?= $this->Form->input("MemberCard..gate_id", array("div" => false, "label" => false, "class" => "select-multiple", 'multiple', 'data-placeholder' => '- Pilih Gate yang diakses -', 'options' => $gateWithTypes, 'id' => 'gate')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive stn-table">
                    <table width="100%" class="table table-hover table-bordered">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Member") ?></h6>
                        </div>
                        <thead>
                            <tr>
                                <th width="50"><?= __("No.") ?></th>
                                <th><?= __("UID") ?></th>
                                <th><?= __("Nama") ?></th>
                                <th><?= __("Expired Date") ?></th>
                                <th width="50"><?= __("Aksi") ?></th>
                            </tr>
                        </thead>
                        <tbody id="target-data-member">
                            <tr>
                                <td class="text-center nomorIdx">1</td>
                                <td class="text-right"><input type="number" class="form-control text-right" name="data[0][Member][uid]" required></td>
                                <td class="text-right"><input type="text" class="form-control text-right" name="data[0][Member][name]" required></td>
                                <td class="text-right"><input type="text" class="form-control datetime text-right" name="data[0][Member][expired_dt]" required></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <a class="text-success" href="javascript:void(false)" onclick="addThisRow($(this), 'data-member')" data-n="1"><i class="icon-plus-circle"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                <input type="reset" value="Reset" class="btn btn-info">
                <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>

<script>
    var gate_ids = <?= json_encode($gate_ids) ?>;
    function check_all(e, target) {
        if ($(e).is(":checked")) {
            target.select2("val", Object.keys(gate_ids));
        } else {
            target.select2("val", "");
        }
    }

    $(document).keypress(
            function (event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });

    function deleteThisRow(e) {
        var tbody = $(e).parents("tbody");
        e.parents("tr").remove();
        fixNumber(tbody);
    }
    function addThisRow(e, t, optFunc) {
        var n = $(e).data("n");
        var template = $('#tmpl-' + t).html();
        Mustache.parse(template);
        var options = {
            i: 2,
            n: n
        };
        if (typeof (optFunc) !== 'undefined') {
            $.extend(options, window[optFunc]());
        }
        var rendered = Mustache.render(template, options);
        $('#target-' + t + " tr:last").before(rendered);
        $(e).data("n", n + 1);
        reloadDatePicker();
        fixNumber($(e).parents("tbody"));
    }
    function fixNumber(e) {
        var i = 1;
        $.each(e.find("tr"), function () {
            $(this).find(".nomorIdx").html(i);
            i++;
        })
    }
</script>
<script type="x-tmpl-mustache" id="tmpl-data-member">
    <tr>
        <td class="text-center nomorIdx">
            {{i}}
        </td>
        <td class="text-right"><input type="number" class="form-control text-right" name="data[{{n}}][Member][uid]" required></td>
        <td class="text-right"><input type="text" class="form-control text-right" name="data[{{n}}][Member][name]" required></td>
        <td class="text-right"><input type="text" class="form-control datetime text-right" name="data[{{n}}][Member][expired_dt]" required></td>
        <td class="text-center">
            <a href="javascript:void(false)" onclick="deleteThisRow($(this))"><i class="icon-remove3"></i></a>
        </td>
    </tr>
</script>