<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
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
                                            echo $this->Form->input("Member.name", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->label("Member.client_id", __("Client"), array("class" => "col-sm-3 col-md-4 control-label"));
                                            echo $this->Form->input("Member.client_id", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "select-full", 'empty' => '', 'placeholder' => '- Pilih Client -'));
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
                            <td width="1%" align="center" valign="middle" bgcolor="#feffc2">Aksi</td>
                        </tr>
                        </thead>
                        <tbody id="target-memberCard">
                        <?php
                        $number = 0;
                        foreach ($this->data["MemberCard"] as $k => $item) {
                            ?>
                            <tr>
                                <?= $this->Form->hidden("MemberCard.$k.id") ?>
                                <td align="center" class="nomorIdx"><?= $k + 1 ?></td>
                                <td>
                                    <div class="false">
                                        <?= $this->Form->input("MemberCard.$k.card_number", ["div" => false, "class" => "form-control", "label" => false, 'required']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="false">
                                        <?= $this->Form->input("MemberCard.$k.expired_dt", ['type' => 'text', 'div' => false, 'class' => 'form-control datepicker', 'label' => false, 'required']) ?>
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
                                <td align="center">
                                    <a href="javascript:void(false)" onclick="deleteThisRow($(this))"><i class="icon-remove3"></i></a>
                                </td>
                            </tr>
                            <?php
                            $number++;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr class="addrowborder">
                            <td colspan="5" align="left"><a href="javascript:void(false)"
                                                            onclick="addThisRow($(this), 'memberCard')" data-n="<?= $number ?>"><i
                                            class="icon-plus-circle"></i></a></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);"
                       class="btn btn-success" value="<?= __("Kembali") ?>">
                <input type="reset" value="Reset" class="btn btn-info">
                <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
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
        reloadDatePicker();
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

<script type="x-tmpl-mustache" id="tmpl-memberCard">
    <tr>
    <td align="center" class="nomorIdx">1</td>
    <td>
    <div class="false">
    <input name="data[MemberCard][{{n}}][card_number]" class="form-control" maxlength="255" type="text" id="MemberCard{{n}}Uid" required>
    </div>
    </td>
    <td>
    <input name="data[MemberCard][{{n}}][expired_dt]" class="form-control datepicker" type="text" id="MemberExpiredDate{{n}}" required>
    </td>
    <td></td>
    <td align="center">
    <a href="javascript:void(false)" onclick="deleteThisRow($(this))"><i class="icon-remove3"></i></a>
    </td>
    </tr>



</script>