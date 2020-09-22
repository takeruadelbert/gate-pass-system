<form action="#" role="form" class="panel-filter">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">Filter Data</h6>
            <div class="panel-icons-group"><a href="#" data-panel="collapse" class="btn btn-link btn-icon"><i
                            class="icon-arrow-up9"></i></a></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Nama") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Member_name']) ? $this->request->query['Member_name'] : '', "name" => "Member.name", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Nomor Kartu") ?></label>
                        <?php
                        $valueCardNumber = isset($this->request->query['cardNumber']) && !empty($this->request->query['cardNumber']) ? $this->request->query['cardNumber'] : "";
                        $valueMemberId = isset($this->request->query['memberId']) && !empty($this->request->query['memberId']) ? $this->request->query['memberId'] : "";
                        ?>
                        <div class="has-feedback">
                            <input type="text" placeholder="Cari Nomor Kartu..." class="form-control typeahead-ajax-uid" name="cardNumber" value="<?= $valueCardNumber ?>">
                            <input type="hidden" name="memberId" id="memberCardId" value="<?= $valueMemberId ?>">
                            <i class="icon-search3 form-control-feedback" style="top: 0;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Client") ?></label>
                        <?= $this->Form->input(null, ['label' => false, 'div' => false, 'class' => 'select-full', 'name' => 'select.Member.client_id', 'data-placeholder' => '- Semua -', 'empty' => '', 'options' => $clients, 'default' => isset($this->request->query['select_Member_client_id']) ? $this->request->query['select_Member_client_id'] : ""]) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("Periode Expired Date") ?></label>
                        <?= $this->Form->input(null, ['type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control datepicker', 'name' => 'awal.Member.expired_dt', 'default' => isset($this->request->query['awal_Member_expired_dt']) ? $this->request->query['awal_Member_expired_dt'] : "", 'placeholder' => "Periode Awal ..."]) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("&nbsp;") ?></label>
                        <?= $this->Form->input(null, ['type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control datepicker', 'name' => 'akhir.Member.expired_dt', 'default' => isset($this->request->query['akhir_Member_expired_dt']) ? $this->request->query['akhir_Member_expired_dt'] : "", 'placeholder' => "Periode Akhir ..."]) ?>
                    </div>
                </div>
            </div>
            <div class="form-actions text-center">
                <input type="button" value="<?= __("Reset") ?>" class="btn btn-danger btn-filter-reset">
                <input type="button" value="<?= __("Cari") ?>" class="btn btn-info btn-filter">
            </div>
        </div>
    </div>
</form>

<script>
    filterReload();
    $(document).ready(function () {
        var member = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('card_number'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '<?= Router::url("/admin/member_cards/list", true) ?>',
            remote: {
                url: '<?= Router::url("/admin/member_cards/list", true) ?>' + '?q=%QUERY',
                wildcard: '%QUERY',
            }
        });
        member.clearPrefetchCache();
        member.initialize(true);
        $('input.typeahead-ajax-uid').typeahead({
            hint: false,
            highlight: true
        }, {
            name: 'member',
            display: 'card_number',
            source: member.ttAdapter(),
            templates: {
                header: '<center><h5>Data Member</h5></center><hr>',
                suggestion: function (data) {
                    return '<p> Nama : ' + data.name + '<br/> Nomor Kartu : ' + data.card_number + '</p>';
                },
                empty: [
                    '<center><h5>Data Member</h5></center><hr> <center><p> Hasil Pencarian Anda Tidak Dapat Ditemukan. </p></center>',
                ]
            }
        });
        $('input.typeahead-ajax-uid').bind('typeahead:select', function (ev, suggestion) {
            $("#memberCardId").val(suggestion.member_id);
        });
    });
</script>
