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
                        <label><?= __("User Group") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'type' => "text", 'class' => "form-control", 'name' => "UserGroup.name", 'default' => isset($this->request->query['UserGroup_name']) ? $this->request->query['UserGroup_name'] : ""]) ?>
                    </div>
                    <div class="col-md-6">
                        <label ><?= __("Label") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'type' => "text", 'class' => "form-control", 'name' => "UserGroup.label", 'default' => isset($this->request->query['UserGroup_label']) ? $this->request->query['UserGroup_label'] : ""]) ?>
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
