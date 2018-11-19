<?php
header('Content-type: application/pdf');
$filename = 'filename.pdf';
header('Content-Disposition: attachment; filename='.$filename);
echo $this->Html->script('jquery.min');
?>
<div class="no-margin text-center" style="width:100%">
    <?php
    $entity = ClassRegistry::init("EntityConfiguration")->find("first");
    ?>
    <div style="display:inline-block">
        <img src="<?= Router::url($entity['EntityConfiguration']['logo1'], true) ?>"/>
    </div>
    <div style="display:inline-block">
        <?php
        echo $entity['EntityConfiguration']['header'];
        ?>
    </div>
</div>
<hr/>
<style>
    .no-margin *{
        margin:0;
    }
    .table-data td{
        text-align: left;
        padding:5px;
    }
    .table-data th{
        text-align: center;
        padding:5px;
    }
    .table-data td:first-child{
        text-align:center !important;
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding:5px;
    }
    .table-data th{
        background-color: lightgray;
    }
    .text-center{
        text-align:center !important;
    }
    table.no-border,.no-border th,.no-border td{
        border:none !important;
        padding:0;
    }
</style>
<?php
echo $this->fetch("content");
?>