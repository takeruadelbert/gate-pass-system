<div class="pull-right">
    <div class="col-xs-12">
        <button  class="btn btn-warning btn-cons" data-toggle="filters"><i class="fa fa-filter"></i> <?php echo __("Filter") ?></button>
        <a href="<?= Router::url("/module-add", true) ?>" class="btn btn-success btn-cons"><i class="fa fa-plus"></i> <?php echo __("Tambah") ?></a>
    </div>
</div>
<div class="quickview-wrapper" id="filters">
    <div class="padding-40 ">
        <a class="builder-close quickview-toggle pg-close" data-toggle="quickview" data-toggle-element="#filters" href="#"></a>
        <form class="panel-filter" role="form" action="#">
            <h5 class="all-caps font-montserrat fs-12 m-b-20"><?= __("Filter") ?></h5>
            <div class="form-group form-group-default">
                <label><?= __("Modul") ?></label>
                <input type="text" name="Module.name" placeholder="<?= __("") ?>" class="form-control">
            </div>
            <div class="form-group form-group-default">
                <label><?= __("Label") ?></label>
                <input type="text" name="Module.name" placeholder="<?= __("") ?>" class="form-control">
            </div>
            <div class="form-group form-group-default">
                <label><?= __("Alias") ?></label>
                <input type="text" name="Module.alias" placeholder="<?= __("") ?>" class="form-control">
            </div>
            <div class="form-group form-group-default">
                <label><?= __("Posisi") ?></label>
                <input type="text" name="Module.position" placeholder="<?= __("") ?>" class="form-control">
            </div>
            <input type="button" class="pull-left btn btn-danger btn-md m-t-40 btn-filter-reset" value="<?php echo __("Reset") ?>"/>
            <input type="button" class="pull-right btn btn-success btn-md m-t-40 btn-filter" value="<?php echo __("Cari") ?>"/>
        </form>
    </div>
</div>