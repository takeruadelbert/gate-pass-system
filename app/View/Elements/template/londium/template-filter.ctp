<form action="#" role="form" class="form-horizontal panel-filter">
    <div class="panel panel-info">
        <div class="panel-heading">
            <span class="pull-left btn btn-xs btn-default toggle-filter" style="margin-left:5px"><i class="icon-filter"></i><?= __("Filter")?></span>
            <h6 class="panel-title">&nbsp;</h6>
            <a href="<?= Router::url("/module-add",true)?>" class="pull-right btn btn-xs btn-default"><i class="icon-plus-circle2"></i><?= __("Tambah")?></a>
        </div>
        <div class="panel-body" style="display:none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("Nama Modul")?></label>
                        <div class="col-md-8">
                            <input type="text" name="Module.name" placeholder="<?= __("")?>" class="form-control input-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("Alias")?></label>
                        <div class="col-md-8">
                            <input type="text" name="Module.alias" placeholder="<?= __("")?>" class="form-control input-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("Icon")?></label>
                        <div class="col-md-8">
                            <input type="text" name="Module.class_icon" placeholder="<?= __("")?>" class="form-control input-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?= __("Posisi")?></label>
                        <div class="col-md-8">
                            <input type="text" name="Module.position" placeholder="<?= __("")?>" class="form-control input-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <input type="button" value="<?= __("Reset")?>" class="btn btn-danger btn-filter-reset">
                <input type="button" value="<?= __("Cari")?>" class="btn btn-info btn-filter">
            </div>
        </div>
    </div>
</form>
<script>
    filterReload();
</script>
