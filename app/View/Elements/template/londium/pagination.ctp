<div id="footer-pagination">
    <div class="row">
        <div class="col-md-6">
            <div class="dataTables_info">
                <?php
                echo $this->Paginator->counter(__($constantString['pagination-tips']));
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dataTables_paginate paging_full_numbers">
                <?php echo $this->Paginator->first('<i class="icon-first"></i>', array('class' => 'first paginate_button', 'escape' => false)); ?>
                <?php echo $this->Paginator->prev('<i class="icon-previous"></i>', array('class' => 'previous paginate_button', 'escape' => false)); ?>
                <span>
                    <?php
                    $numbers = $this->Paginator->numbers(array("class" => "paginate_button", "currentClass" => "paginate_active", "separator" => null));
                    if (!empty($numbers)) {
                        echo $numbers;
                    } else {
                        echo "<span class='paginate_active'>1</span>";
                    }
                    ?>
                </span>
                <?php echo $this->Paginator->next('<i class="icon-next"></i>', array('class' => 'next paginate_button', 'escape' => false)); ?>
                <?php echo $this->Paginator->last('<i class="icon-last"></i>', array('class' => 'last paginate_button', 'escape' => false)); ?>
            </div>
        </div>
    </div>
</div>
<?php
if (empty($_SERVER['QUERY_STRING'])) {
    $get = '';
} else {
    $get = "?{$_SERVER['QUERY_STRING']}";
}
?>
<div id="header-pagination">
    <div class="dataTables_length">
        <label>
            <span>Show entries:</span> 
            <select size="1" class="select2-offscreen" style="overflow:none" id="pagination-limit">
                <?php
                $limits = array(
                    5 => '5',
                    10 => 10,
                    25 => '25',
                    50 => '50',
                    100 => '100',
                    250 => '250',
                    500 => '500',
                    1000 => '1000',
                    2500 => '2500',
                    5000 => '5000'
                );
                $options = null;
                if (isset($this->params['named']['limit'])) {
                    $selected = $this->params['named']['limit'];
                } elseif (isset($this->params['named']['show'])) {
                    $selected = $this->params['named']['show'];
                } else {
                    $selected = 10;
                }
                foreach ($limits as $k => $v) {
                    if ($k == $selected) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    $options .= '<option data-url="' . Router::url("/".$ACTION_URL, true) . "/limit:{$k}{$get}" . '" ' . $select . ' value="' . $k . '">' . $v . '</option>';
                }
                echo $options;
                ?>
            </select>
        </label>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#pagination-limit").bind("change", function() {
            window.location.href = $("#pagination-limit option:selected").data("url");
        })
    })
</script>