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
                        <label><?= __("Nama Akun") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'class' => 'form-control tip', 'name' => 'User.username', 'default' => isset($this->request->query['User_username']) ? $this->request->query['User_username'] : ""]) ?>
                    </div>
                    <div class="col-md-6">
                        <label ><?= __("Email") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'class' => 'form-control tip', 'name' => "User.email", 'default' => isset($this->request->query['User_email']) ? $this->request->query['User_email'] : ""]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Nama Depan") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'class' => 'form-control tip', 'name' => "Biodata.first_name", 'default' => isset($this->request->query['Biodata_first_name']) ? $this->request->query['Biodata_first_name'] : ""]) ?>
                    </div>
                    <div class="col-md-6">
                        <label ><?= __("Nama Belakang") ?></label>
                        <?= $this->Form->input(null, ['div' => false, 'label' => false, 'class' => 'form-control tip', 'name' => "Biodata.last_name", 'default' => isset($this->request->query['Biodata_last_name']) ? $this->request->query['Biodata_last_name'] : ""]) ?>
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
