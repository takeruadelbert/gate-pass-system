<div id="footer-pagination">
    <div class="row">
        <div>
            <div class="dataTables_paginate paging_bootstrap pagination" id="tableWithExportOptions_paginate">
                <ul>
                    <?php echo $this->Paginator->prev('<i class="pg-arrow_left"></i>', array('class' => 'prev', 'tag' => "li", 'escape' => false)); ?>
                    <?php
                    $numbers = $this->Paginator->numbers(array("class" => "", "tag" => "li", "currentClass" => "active", "separator" => null));
                    if (!empty($numbers)) {
                        echo $numbers;
                    } else {
                        echo "<li class='active'>1</li>";
                    }
                    ?>
                    <?php echo $this->Paginator->next('<i class="pg-arrow_right"></i>', array('class' => 'prev', 'tag' => "li", 'escape' => false)); ?>
                </ul>
            </div>
            <div class="dataTables_info" role="status" aria-live="polite">
                <?php
                echo $this->Paginator->counter(__($constantString['pagination-tips']));
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/stn_cake_base/template/pages-ace/assets/js/datatables.js"></script>
<script>
    $(document).ready(function() {
        var $active = $(".pagination .active");
        $active.html("<a>" + $active.html() + "</a>");
    })
</script>