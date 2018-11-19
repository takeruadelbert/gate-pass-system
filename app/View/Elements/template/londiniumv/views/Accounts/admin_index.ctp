<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/account");
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("DATA PENGGUNA") ?>
                <div class="pull-right">
                    <button class="btn btn-xs btn-default" type="button" onclick="exp('print', '<?php echo Router::url("index/print?" . $_SERVER['QUERY_STRING'], true) ?>')">
                        <i class="icon-print2"></i> 
                        <?= __("Cetak") ?>
                    </button>&nbsp;
                    <button class="btn btn-xs btn-default" type="button" onclick="exp('excel', '<?php echo Router::url("index/excel?" . $_SERVER['QUERY_STRING'], true) ?>')">
                        <i class="icon-file-excel"></i>
                        Excel
                    </button>&nbsp;
                    <?= $this->element(_TEMPLATE_DIR . "/{$template}/roleaccess/add") ?>
                </div>
                <small class="display-block"></small>
            </h6>
        </div>
        <div class="table-responsive pre-scrollable stn-table">
            <form id="checkboxForm" method="post" name="checkboxForm" action="<?php echo Router::url('/' . $this->params['prefix'] . '/' . $this->params['controller'] . '/multiple_delete', true); ?>">
                <table width="100%" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50"><input type="checkbox" class="styled checkall"/></th>
                            <th width="50">No</th>
                            <th><?= __("Username") ?></th>
                            <th><?= __("Nama Depan") ?></th>
                            <th><?= __("Nama Belakang") ?></th>
                            <th><?= __("Email") ?></th>
                            <th><?= __("User Group") ?></th>
                            <th><?= __("Alamat") ?></th>
                            <th><?= __("No. Handphone") ?></th>
                            <th><?= __("Status Pengguna") ?></th>
                            <th width="100"><?= __("Aksi") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                        $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                        $i = ($limit * $page) - ($limit - 1);
                        if (empty($data['rows'])) {
                            ?>
                            <tr>
                                <td class = "text-center" colspan = 13>Tidak Ada Data</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($data['rows'] as $item) {
                                ?>
                                <tr id="row-<?= $i ?>" class="removeRow<?php echo $item[Inflector::classify($this->params['controller'])]['id']; ?>">
                                    <td class="text-center"><input type="checkbox" name="data[<?php echo Inflector::classify($this->params['controller']) ?>][checkbox][]" value="<?php echo $item[Inflector::classify($this->params['controller'])]['id']; ?>"  id="checkBoxRow" class="styled checkboxDeleteRow" /></td>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $item['User']['username'] ?></td>
                                    <td><?= $item['Biodata']['first_name'] ?></td>
                                    <td><?= $item['Biodata']['last_name'] ?></td>
                                    <td><?= $item['User']['email'] ?></td>
                                    <td><?= $userGroups[$item['User']['user_group_id']] ?></td>
                                    <td><?= $item['Biodata']['address'] ?></td>
                                    <td><?= $item['Biodata']['handphone'] ?></td>
                                    <td>
                                        <?php
                                        if ($roleAccess['edit']) {
                                            echo $this->Html->changeStatusSelect($item['Account']['id'], ClassRegistry::init("AccountStatus")->find("list", array("fields" => array("AccountStatus.id", "AccountStatus.name"))), $item['Account']['account_status_id'], Router::url("/admin/accounts/change_status"), null);
                                        } else {
                                            echo $item['AccountStatus']['name'];
                                        }
                                        ?>
                                    </td>  
                                    <td class="text-center">
                                        <a href="#"><button type="button" class="btn btn-default btn-xs btn-icon tip" title="Detail"><i class="icon-file"></i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <?php echo $this->element(_TEMPLATE_DIR . "/{$template}/pagination") ?>
</div>

