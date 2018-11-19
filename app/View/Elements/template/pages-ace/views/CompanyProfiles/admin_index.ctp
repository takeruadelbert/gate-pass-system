<div class="container-fluid container-fixed-lg bg-white">
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-table"></i><?= __("Profil Perusahaan") ?></h6>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped" id="tableWithDynamicRows">
                <thead>
                    <tr>
                        <th><?= __("Logo") ?></th>
                        <th><?= __("Nama Perusahaan") ?></th>
                        <th><?= __("Alamat") ?></th>
                        <th><?= __("Provinsi") ?></th>
                        <th><?= __("Kota") ?></th>
                        <th><?= __("Telepon") ?></th>
                        <th><?= __("Email") ?></th>
                        <th><?= __("Aksi") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                    $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                    $i = ($limit * $page) - ($limit - 1);
                    foreach ($data['rows'] as $item) {
                        ?>
                        <tr id="row-<?= $i ?>">
                            <td><img src="<?= isset($item["CompanyProfile"]['path_logo']) ? $item["CompanyProfile"]['path_logo'] : Router::url("/img/no_image.jpg") ?>" style="height:40px;width:40px "/></td>
                            <td><?= $item['CompanyProfile']['company_name'] ?></td>
                            <td><?= $item['CompanyProfile']['address'] ?></td>
                            <td><?= $item['State']['name'] ?></td>
                            <td><?= $item['City']['name'] ?></td>
                            <td><?= $item['CompanyProfile']['phone'] ?></td>
                            <td><?= $item['CompanyProfile']['email'] ?></td>
                            <td><a href="<?= Router::url("/{$url}-edit/{$item[Inflector::classify($this->params['controller'])]['id']}", true) ?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>