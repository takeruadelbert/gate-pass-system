<form action="#" role="form" class="panel-filter">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">Filter Data</h6>
            <div class="panel-icons-group"> <a href="#" data-panel="collapse" class="btn btn-link btn-icon"><i class="icon-arrow-up9"></i></a></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("UID") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Member_uid']) ? $this->request->query['Member_uid'] : '', "name" => "Member.uid", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Nama") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Member_name']) ? $this->request->query['Member_name'] : '', "name" => "Member.name", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label><?= __("Periode Expired Date") ?></label>
                        <?= $this->Form->input(null, ['type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control datepicker', 'name' => 'awal.Member.expired_dt', 'default' => isset($this->request->query['awal_Member_expired_dt']) ? $this->request->query['awal_Member_expired_dt'] : "", 'placeholder' => "Periode Awal ..."]) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("&nbsp;") ?></label>
                        <?= $this->Form->input(null, ['type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control datepicker', 'name' => 'akhir.Member.expired_dt', 'default' => isset($this->request->query['akhir_Member_expired_dt']) ? $this->request->query['akhir_Member_expired_dt'] : "", 'placeholder' => "Periode Akhir ..."]) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Gate") ?></label>
                        <?= $this->Form->input(null, ['label' => false, 'div' => false, 'class' => 'select-multiple', 'name' => 'gates[]', 'data-placeholder' => '- Semua -', 'multiple', 'options' => $gateWithTypes, 'default' => !empty($chosen_gate) ? $chosen_gate : ""]) ?>
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
</script>
