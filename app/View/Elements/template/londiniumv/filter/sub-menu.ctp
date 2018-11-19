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
                        <label><?= __("Nama Sub Menu") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['SubMenu_label']) ? $this->request->query['SubMenu_label'] : '', "name" => "SubMenu.label", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Modul") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['SubMenu_module_id']) ? $this->request->query['SubMenu_module_id'] : '', "name" => "SubMenu.module_id", "div" => false, "label" => false, "class" => "select-full", "options" => $modules, "empty" => "-Semua-")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Menu") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['SubMenu_menu_id']) ? $this->request->query['SubMenu_menu_id'] : '', "name" => "SubMenu.menu_id", "div" => false, "label" => false, "class" => "select-full", "options" => $menus, "empty" => "-Semua-")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Parent") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['SubMenu_parent_id']) ? $this->request->query['SubMenu_parent_id'] : '', "name" => "SubMenu.parent_id", "div" => false, "label" => false, "class" => "select-full", "options" => $parents, "empty" => "-Semua-")) ?>
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
