<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/history");
?>
<style>
    .previewImage {
        width: 200px;
        height: 150px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("DATA HISTORY") ?>
                <div class="pull-right">
                    <button class="btn btn-xs btn-default" type="button" onclick="exp('excel', '<?php echo Router::url("index/excel?" . $_SERVER['QUERY_STRING'], true) ?>')">
                        <i class="icon-file-excel"></i>
                        Excel
                    </button>&nbsp;
                </div>
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
                                    <td class="text-center"><?= $this->Echo->empty_strip(@$item['History']['name']) ?></td>
                                    <td class="text-center"><?= $this->Html->cvtWaktu($item['History']['datetime']) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $imageFace = @$item['History']['image_face'];
                                        if($imageFace !== null) {
                                            $image = "data:image/jpeg;base64,". base64_encode($imageFace);
                                            ?>
                                        <div class="thumbnail thumbnail-boxed previewImage">
                                            <a href="<?= $image ?>" class="thumb-zoom lightbox" title="<?= $item['History']['name'] ?>">
                                                <img src="<?= $image ?>" width="200" height="150" />
                                            </a>
                                        </div>
                                            <?php
                                        } else {
                                         ?>
                                            <img src="<?= Router::url("/img/no_image.jpg", true) ?>" width="100" height="100"/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $imagePlate = @$item['History']['image_plate'];
                                        if($imagePlate !== null) {
                                            $image = "data:image/jpeg;base64,". base64_encode($imagePlate);
                                            ?>
                                            <div class="thumbnail thumbnail-boxed previewImage">
                                                <a href="<?= $image ?>" class="thumb-zoom lightbox" title="<?= $item['History']['name'] ?>">
                                                    <img src="<?= $image ?>" width="200" height="150" />
                                                </a>
                                            </div>
                                                <?php
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

