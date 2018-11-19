<div class="row">
    <div class="col-md-2">
        <div class="block">
            <div class="block">
                <div class="thumbnail">
                    <div class="thumb"><img alt="" src="<?= Router::url('/', true) . $this->Session->read("credential.admin.User.profile_picture") ?>">
                        <div class="thumb-options"><span><a onclick="modalChangepp()" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a></span></div>
                    </div>
                    <div class="caption text-center">
                        <h6><?= $this->Echo->fullName($this->Session->read("credential.admin.Biodata")) ?> <small><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id")) ?></small></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>