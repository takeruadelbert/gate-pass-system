<div class="container-fluid container-fixed-lg bg-white">
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-table"></i><?= __("Bowl") ?></h6>
            <?php
            echo $this->element(_TEMPLATE_DIR."/{$template}/filter/bowl");
            ?>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-hover" id="tableWithDynamicRows">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= __("Nama") ?></th>
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
                            <td><?= $i ?></td>
                            <td><?= $item['Bowl']['name'] ?></td>
                            <td><a href="<?= Router::url("/admin/{$this->params['controller']}/edit/{$item[Inflector::classify($this->params['controller'])]['id']}", true) ?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a>&nbsp;<span class="btn btn-danger" onclick="hapusData(<?= $item[Inflector::classify($this->params['controller'])]['id']; ?>, '#row-<?= $i ?>')"><?= __("Hapus") ?></span></td>
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
<?php echo $this->element(_TEMPLATE_DIR."/{$template}/pagination") ?>
