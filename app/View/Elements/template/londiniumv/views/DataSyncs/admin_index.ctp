<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/data-sync");
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("DATA SYNC") ?>
                <small class="display-block"></small>
            </h6>
        </div>
        <div class="table-responsive pre-scrollable stn-table">
            <form id="checkboxForm" method="post" name="checkboxForm" action="<?php echo Router::url('/' . $this->params['prefix'] . '/' . $this->params['controller'] . '/multiple_delete', true); ?>">
                <table width="100%" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="10%"><?= __("Datetime") ?></th>
                            <th width="10%"><?= __("URL") ?></th>
                            <th width="10%"><?= __("Header") ?></th>
                            <th width="2%"><?= __("HTTP Request Method") ?></th>
                            <th width="30%"><?= __("Payload Data") ?></th>
                            <th width="5%"><?= __("Has Been Synced?") ?></th>
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
                                <td class = "text-center" colspan = 7>Tidak Ada Data</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($data['rows'] as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $this->Html->cvtWaktu($item['DataSync']['created']) ?></td>
                                    <td class="text-center">
                                        <code><?= $item['DataSync']['url'] ?></code>
                                    </td>
                                    <td class="text-center"><?= $item['DataSync']['header'] ?></td>
                                    <td class="text-center">
                                        <?php
                                        $type = $item['DataSync']['request_method'] === 'POST' ? 'info' : 'danger';
                                        ?>
                                        <span class="label label-<?= $type ?>"><?= $item['DataSync']['request_method'] ?></span>
                                    </td>
                                    <td class="text-center"><?= $item['DataSync']['data'] ?></td>
                                    <td class="text-center">
                                        <?php
                                        $labelType = $item['DataSync']['has_synced'] ? 'success' : 'warning';
                                        $labelValue = $item['DataSync']['has_synced'] ? 'Yes' : "No";
                                        ?>
                                        <span class="label label-<?= $labelType ?>"><?= $labelValue ?></span>
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

