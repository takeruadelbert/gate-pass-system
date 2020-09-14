<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/history");
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("DATA HISTORY") ?>
                <small class="display-block"></small>
            </h6>
        </div>
        <div class="table-responsive pre-scrollable stn-table">
            <form id="checkboxForm" method="post" name="checkboxForm" action="<?php echo Router::url('/' . $this->params['prefix'] . '/' . $this->params['controller'] . '/multiple_delete', true); ?>">
                <table width="100%" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th><?= __("UID Card") ?></th>
                            <th><?= __("Nama") ?></th>
                            <th><?= __("Tangga/Waktu") ?></th>
                            <th><?= __("Image Face") ?></th>
                            <th><?= __("Image Plate") ?></th>
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
                                <td class = "text-center" colspan = 6>Tidak Ada Data</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($data['rows'] as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $item['History']['code'] ?></td>
                                    <td class="text-center"><?= $item['History']['name'] ?></td>
                                    <td class="text-center"><?= $this->Html->cvtWaktu($item['History']['datetime']) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $imageFace = @$item['History']['image_face'];
                                        if($imageFace !== null) {
                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($imageFace) .'" width=200 height=150 />';
                                        } else {
                                         ?>
                                            <img src="<?= Router::url("/img/no_image.jpg", true) ?>"/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $imagePlate = @$item['History']['image_plate'];
                                        if($imagePlate !== null) {
                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($imagePlate) .'" />';
                                        } else {
                                            ?>
                                            <img src="<?= Router::url("/img/no_image.jpg", true) ?>" width="100" height="100" />
                                            <?php
                                        }
                                        ?>
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

