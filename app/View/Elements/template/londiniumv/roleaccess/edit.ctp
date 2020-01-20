<?php
if (!isset($editTitle)) {
    $editTitle = "Ubah";
}
if (!isset($editUrl)) {
    $editUrl = "#";
}
if (!isset($editIcon)) {
    $editIcon = "icon-pencil";
}
if ($roleAccess['edit']) {
    ?>
    <a href="<?= $editUrl ?>"><button type="button" class="btn btn-default btn-xs btn-icon tip" title="<?= __($editTitle) ?>"><i class="<?= $editIcon ?>"></i></button></a>
    <?php
}
?>