<?php
if (!isset($deleteLabel)) {
    $deleteLabel = "Hapus Data";
}
if (!isset($deleteUrl)) {
    $deleteUrl = Router::url('/admin/popups/content?content=confirm', true);
}
if ($roleAccess['delete']) {
    ?>
    <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#multipledelete" type="button" href="<?= $deleteUrl ?>">
        <i class="icon-file-remove"></i> 
        <?= __($deleteLabel) ?>
    </button>&nbsp;
    <?php
}
?>