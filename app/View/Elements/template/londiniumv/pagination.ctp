<?php
if (empty($_SERVER['QUERY_STRING'])) {
    $get = '';
} else {
    $get = "?{$_SERVER['QUERY_STRING']}";
}
?>
<div id="footer-pagination">
    <div class="row">
        <div class="col-md-4 pull-left">
            <div class="dataTables_length">
                <label>
                    <span><?= __("Menampilkan") ?>:</span> 
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
                            $options .= '<option data-url="' . Router::url("/" . $ACTION_URL, true) . "/limit:{$k}{$get}" . '" ' . $select . ' value="' . $k . '">' . $v . '</option>';
                        }
                        echo $options;
                        ?>
                    </select>
                </label>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="dataTables_info">
                <?php
                echo $this->Paginator->counter(__($constantString['pagination-tips']));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <ul class="pagination pull-right dataTables_paginate" style="margin-right:10px;">
                <?php echo $this->Paginator->first('<i class="icon-first"></i>', array('class' => 'c-pagination', 'escape' => false, "tag" => "li"), null, array("class" => "disabled c-pagination")); ?>
                <?php echo $this->Paginator->prev('<i class="icon-previous"></i>', array('class' => 'c-pagination', 'escape' => false, "tag" => "li"), null, array("class" => "disabled c-pagination")); ?>
                <?php
                $numbers = $this->Paginator->numbers(array("currentTag" => "a", "currentClass" => "active", "separator" => null, "tag" => "li"));
                if (!empty($numbers)) {
                    echo $numbers;
                } else {
                    echo "<li class='active'><a href='#'>1</a></li>";
                }
                ?>
                <?php echo $this->Paginator->next('<i class="icon-next"></i>', array('class' => 'c-pagination', 'escape' => false, "tag" => "li"), null, array("class" => "disabled c-pagination")); ?>
                <?php echo $this->Paginator->last('<i class="icon-last"></i>', array('class' => 'c-pagination', 'escape' => false, "tag" => "li"), null, array("class" => "disabled c-pagination")); ?>
            </ul>
        </div>
    </div>
</div>
<div id="header-pagination">

</div>
<script>
    $(document).ready(function () {
        $("#pagination-limit").bind("change", function () {
            window.location.href = $("#pagination-limit option:selected").data("url");
        })
        $(".c-pagination").each(function () {
            var aEle = $(this).find("a");
            if (aEle.length == 0) {
                var html = $(this).html();
                console.log()
                $(this).html("").append("<a></a>").find("a").html(html);
            }
        })
    })
</script>