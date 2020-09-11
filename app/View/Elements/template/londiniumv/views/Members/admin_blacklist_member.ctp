<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "blacklist_member", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Blacklist Member") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Member") ?></h6>
                        </div>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-sm-3 col-md-4 control-label">
                                                <label>Nama Member</label>
                                            </div>
                                            <div class="col-sm-9 col-md-8">
                                                <div class="has-feedback">
                                                    <input type="text" placeholder="Cari Nama ..." class="form-control typeahead-ajax-name">
                                                    <input type="hidden" name="data[Member][id]" id="memberId">
                                                    <i class="icon-search3 form-control-feedback"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-actions text-center">
                    <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                    <input type="reset" value="Reset" class="btn btn-info">
                    <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>

<script>
    $(document).ready(function () {
        var member = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '<?= Router::url("/admin/members/list", true) ?>',
            remote: {
                url: '<?= Router::url("/admin/members/list", true) ?>' + '?q=%QUERY',
                wildcard: '%QUERY',
            }
        });
        member.clearPrefetchCache();
        member.initialize(true);
        $('input.typeahead-ajax-name').typeahead({
            hint: false,
            highlight: true
        }, {
            name: 'member',
            display: 'name',
            source: member.ttAdapter(),
            templates: {
                header: '<center><h5>Data Member</h5></center><hr>',
                suggestion: function (data) {
                    return '<p> Nama : ' + data.name + '</p>';
                },
                empty: [
                    '<center><h5>Data Member</h5></center><hr> <center><p> Hasil Pencarian Anda Tidak Dapat Ditemukan. </p></center>',
                ]
            }
        });
        $('input.typeahead-ajax-name').bind('typeahead:select', function (ev, suggestion) {
            $("#memberId").val(suggestion.id);
        });
    });
</script>