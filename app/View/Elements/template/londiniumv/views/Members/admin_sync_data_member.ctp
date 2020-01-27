<?php echo $this->Form->create("Member", array("class" => "form-horizontal form-separate", "action" => "snyc_data_member", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php
            if (!empty($dataClient)) {
                foreach ($dataClient as $client) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="block-inner text-danger">
                                <h6 class="heading-hr"><?= __($client['Client']['name']) ?>
                                </h6>
                            </div>
                            <div class="col-sm-3 col-md-3">

                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="table-responsive stn-table">
                                    <table width="100%" class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="50"><?= __("No.") ?></th>
                                            <th><?= __("Nama Gate") ?></th>
                                            <th width="50"><?= __("Aksi") ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        if (empty($client['Gate'])) {
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="3">Tidak Ada Data</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($client['Gate'] as $gate) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $i ?></td>
                                                    <td class="text-center"><?= $gate['full_label'] ?></td>
                                                    <td class="text-center"><a
                                                                href="<?= Router::url("/admin/{$this->params['controller']}/sync_data_member_gate/{$gate['id']}", true) ?>">
                                                            <button type="button"
                                                                    class="btn btn-default btn-xs btn-icon tip"
                                                                    title="<?= __("Connect ke {$gate['name']}") ?>"><i
                                                                        class="icon-contract2"></i></button>
                                                        </a></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">

                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="form-actions text-center">
                <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success"
                       value="<?= __("Kembali") ?>">
            </div>
            <br>
        </div>
    </div>
<?php echo $this->Form->end() ?>