<div class="row">
    <div class="col-lg-2">
        <!-- Profile links -->
        <div class="block">
            <div class="block">
                <div class="thumbnail">
                    <img alt="" src="<?= Router::url($this->Session->read("credential.admin.User.profile_picture"), true) ?>" width='150' height="150">
                        <div class="thumb-options">
                            <span>
                                <a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
                                <a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>
                            </span>
                        </div>
                    <div class="caption text-center">
                        <h6><?= $this->Session->read("credential.admin.Biodata.full_name") ?> <small><?= $this->Echo->userGroup($this->Session->read("credential.admin.User.user_group_id")) ?></small></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- /profile links -->
  </div>
  <div class="col-lg-10">
        <!-- Page tabs -->
        <div class="tabbable page-tabs">
            <div class="tab-content">
                <!-- First tab -->
                <div class="tab-pane active fade in" id="activity">
                    <!-- Profile information -->
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-pills nav-justified">
                            <li class="active">
                                <a href="#activity" data-toggle="tab"><i class="icon-paragraph-justify2"></i> Data Member</a>
                            </li>
                        </ul>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Username:</label>
                                    <input type="text" value="<?= $this->Session->read("credential.admin.User.username") ?>" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active fade in" id="activity">
                            <!-- Profile information -->
                            <div class="tabbable page-tabs">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="active">
                                        <a href="#activity" data-toggle="tab"><i class="icon-paragraph-justify2"></i> Data Profil</a>
                                    </li>
                                </ul>
                                <div class="block-inner">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" value="<?= $this->Session->read("credential.admin.Biodata.full_name") ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tanggal Lahir:</label>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" value="<?= date("d", strtotime($this->Session->read("credential.admin.Biodata.tanggal_lahir"))) ?>" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" value="<?= date("F", strtotime($this->Session->read("credential.admin.Biodata.tanggal_lahir"))) ?>" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" value="<?= date("Y", strtotime($this->Session->read("credential.admin.Biodata.tanggal_lahir"))) ?>" readonly>
                                                    </div>
                                                </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Alamat Lengkap</label>
                                    <input type="text" class="form-control" value="<?= $this->Session->read("credential.admin.Biodata.address") ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" value="<?= $this->Echo->city($this->Session->read("credential.admin.Biodata.city_id")) ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Provinsi</label>
                                    <input type="text" class="form-control" value="<?= $this->Echo->state($this->Session->read("credential.admin.Biodata.state_id")) ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Kode Pos</label>
                                    <input type="text" class="form-control" value="<?= $this->Session->read("credential.admin.Biodata.postal_code") ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="<?= $this->Session->read("credential.admin.User.email") ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Negara :</label>
                                    <input type="text" class="form-control" value="<?= $this->Echo->country($this->Session->read("credential.admin.Biodata.country_id")) ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="<?= $this->Session->read("credential.admin.Biodata.phone") ?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label>Handphone</label>
                                    <input type="text" class="form-control" placeholder="<?= $this->Session->read("credential.admin.Biodata.handphone") ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>