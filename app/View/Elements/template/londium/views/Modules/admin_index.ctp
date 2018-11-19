<?php
echo $this->element(_TEMPLATE_DIR."/{$template}/filter/module");
?>
<div class="panel panel-default">
    <div class="datatable-pagination">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= __("Label") ?></th>
                    <th><?= __("Alias") ?></th>
                    <th><?= __("Icon") ?></th>
                    <th><?= __("Posisi") ?></th>
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
                        <td><?= $item['Module']['name'] ?></td>
                        <td><?= $this->Echo->empty_strip($item['Module']['alias']) ?></td>
                        <td><?= "<i class='{$item['Module']['class_icon']}'></i> ({$item['Module']['class_icon']})" ?></td>
                        <td><?= $item['Module']['position'] ?></td>
                        <td><a href="<?= Router::url("/admin/modules/edit/{$item['Module']['id']}") ?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a>&nbsp;<span class="btn btn-danger" onclick="hapusData(<?= $item[Inflector::classify($this->params['controller'])]['id']; ?>,'#row-<?= $i ?>')"><?= __("Hapus") ?></span></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->element(_TEMPLATE_DIR."/{$template}/pagination") ?>
