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
                        <label><?= __("UID Card") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['History_code']) ? $this->request->query['History_code'] : '', "name" => "History.code", "div" => false, "label" => false, "class" => "form-control tip", "placeholder" => "UID card")) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("Periode Tanggal") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['start_date']) ? $this->request->query['start_date'] : '', "name" => "start_date", "div" => false, "label" => false, "class" => "form-control datetime", 'placeholder' => 'Periode Awal', 'id' => "startDate")) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("&nbsp;") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['end_date']) ? $this->request->query['end_date'] : '', "name" => "end_date", "div" => false, "label" => false, "class" => "form-control datetime", 'placeholder' => 'Periode Akhir', 'id' => "endDate")) ?>
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
