<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/account");
?>
<div class="panel panel-default">
    <div class="datatable-pagination">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= __("Username") ?></th>
                    <th><?= __("Nama Depan") ?></th>
                    <th><?= __("Nama Belakang") ?></th>
                    <th><?= __("Email") ?></th>
                    <th><?= __("User Group") ?></th>
                    <th><?= __("Alamat") ?></th>
                    <th><?= __("No. Handphone") ?></th>
                    <th><?= __("Status Pengguna") ?></th>
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
                        <td><?= $item['User']['username'] ?></td>
                        <td><?= $item['Biodata']['first_name'] ?></td>
                        <td><?= $item['Biodata']['last_name'] ?></td>
                        <td><?= $item['User']['email'] ?></td>
                        <td><?= $userGroups[$item['User']['user_group_id']] ?></td>
                        <td><?= $item['Biodata']['address'] ?></td>
                        <td><?= $item['Biodata']['handphone'] ?></td>
                        <td>
                            <?php
                            echo $this->Html->changeStatusSelect($item['Account']['id'], ClassRegistry::init("AccountStatus")->find("list", array("fields" => array("AccountStatus.id", "AccountStatus.name"))), $item['Account']['account_status_id'], Router::url("/admin/accounts/change_status"), null);
                            ?>
                        </td>    
                        <td>
                            <a href="<?= Router::url("/{$url}/edit/{$item[Inflector::classify($this->params['controller'])]['id']}", true) ?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->element(_TEMPLATE_DIR . "/{$template}/pagination") ?>
