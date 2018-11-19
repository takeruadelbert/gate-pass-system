<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?php echo Router::url("/admin/dashboard") ?>">Dashboard</a></li>
        <?php
        $bcSuggestion = array_reverse($bcSuggestion);
        foreach ($bcSuggestion as $bc) {
            if (empty($bc['alias'])) {
                echo "<li>{$bc['label']}</li>";
            } else {
                echo "<li><a href='".Router::url("/".$bc['alias'],true)."' class='active'>{$bc['label']}</a></li>";
            }
        }
        ?>
    </ul>
</div>