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
                        <label><?= __("Nama Pegawai") ?></label>
                        <?= $this->Form->input(null, ["default" => isset($this->request->query['Biodata_first_name']) ? $this->request->query['Biodata_first_name'] : '', "name" => "Biodata.first_name", "class" => "form-control", "div" => false, "label" => false]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label><?= __("Bidang") ?></label>
                    <?= $this->Form->input(null, ["default" => isset($this->request->query['select_Employee_department_id']) ? $this->request->query['select_Employee_department_id'] : 0, "name" => "select.Employee.department_id", "options" => $departments, "class" => "select-full", "div" => false, "label" => false, "empty" => "- Semua -"]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Jenis Kelamin") ?></label>
                        <?= $this->Form->input(null, ["default" => isset($this->request->query['select_Biodata_gender_id']) ? $this->request->query['select_Biodata_gender_id'] : 0, "name" => "select.Biodata.gender_id", "options" => $genders, "class" => "select-full", "div" => false, "label" => false, "empty" => "- Semua -"]) ?>
                    </div>

                </div>
            </div>
            <div c
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
