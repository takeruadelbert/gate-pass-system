<form action="#" role="form" class="form-horizontal panel-filter">
    <div class="panel panel-info">
        <div class="panel-heading">
            <span class="pull-left btn btn-xs btn-default toggle-bar" style="margin-left:5px" data-toggle-target="filter"><i class="icon-filter"></i><?= __("Filter") ?></span>
            <h6 class="panel-title">&nbsp;</h6>
            <a href="<?= Router::url("/admin/roles/add", true) ?>" class="pull-right btn btn-xs btn-default"><i class="icon-plus-circle2"></i><?= __("Tambah") ?></a>
        </div>
        <div class="panel-body toggle-target" style="display:none" data-toggle-id="filter">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("User Group") ?></label>
                        <div class="col-md-8">
                            <?= $this->Form->input(null, ['label' => false, "div" => false, 'options' => $userGroups, "name" => "Role.user_group_id", "class" => "form-control input-sm", "empty" => "-"]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("Modul") ?></label>
                        <div class="col-md-8">
                            <?= $this->Form->input(null, ['label' => false, "div" => false, 'options' => $modules, "name" => "Role.module_id", "class" => "form-control input-sm", "empty" => "-"]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <input type="button" value="<?= __("Reset") ?>" class="btn btn-danger btn-filter-reset">
                <input type="button" value="<?= __("Cari") ?>" class="btn btn-info btn-filter">
            </div>
        </div>
        <div class="panel-body toggle-target" style="display:none" data-toggle-id="export">
            <div class="form-actions">
                <span class="btn btn-default btn-xs" style="margin-left:5px" onclick="exp('print', '<?php echo Router::url("index/print?" . $_SERVER['QUERY_STRING'], true) ?>')"><i class="icon-print"></i><?= __("Print") ?></span>
                <span class="btn btn-default btn-xs" style="margin-left:5px" onclick="exp('pdf', '<?php echo Router::url("index/pdf?" . $_SERVER['QUERY_STRING'], true) ?>')"><i class="icon-file-pdf"></i><?= __("PDF") ?></span>
                <span class="btn btn-default btn-xs" style="margin-left:5px" onclick="exp('excel', '<?php echo Router::url("index/excel?" . $_SERVER['QUERY_STRING'], true) ?>')"><i class="icon-file-excel"></i><?= __("Excel") ?></span>
            </div>
        </div>
    </div>
</form>
<script>
    filterReload();
</script>
