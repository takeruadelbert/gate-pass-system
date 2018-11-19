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
                        <label><?= __("Label") ?></label>
                        <input type="text" name="ModuleContent.name" placeholder="<?= __("") ?>" class="form-control tip">
                    </div>
                    <div class="col-md-6">
                        <label ><?= __("Alias") ?></label>
                        <input type="text" name="Module.alias" placeholder="<?= __("") ?>" class="form-control tip">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Modul") ?></label>
                        <?= $this->Form->input(null, ['label' => false, "div" => false, 'options' => $modules, "name" => "select.ModuleContent.module_id", "class" => "select-full","empty"=>"-".__("Semua")."-"]) ?>
                    </div>
                    <div class="col-md-6">
                        <label ><?= __("Parent") ?></label>
                        <?= $this->Form->input(null, ['label' => false, "div" => false, 'options' => $moduleContents, "name" => "select.ModuleContent.parent_id", "class" => "select-full","empty"=>"-".__("Semua")."-"]) ?>
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
