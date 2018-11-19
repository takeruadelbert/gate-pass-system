<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th><?= __("Label") ?></th>
            <th><?= __("Alias") ?></th>
            <th><?= __("Module") ?></th>
            <th><?= __("Parent") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
        $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
        $i = ($limit * $page) - ($limit - 1);
        foreach ($data['rows'] as $item) {
            ?>
            <tr id="row-<?= $i ?>">
                <td><?= $i ?></td>
                <td><?= $item['ModuleContent']['name'] ?></td>
                <td><?= $this->Echo->empty_strip($item['ModuleContent']['alias']) ?></td>
                <td><?= $item['Module']['name'] ?></td>
                <td><?= $this->Echo->empty_strip($item['Parent']['name']) ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </tbody>
</table>
<style>
    .table td{
        vertical-align: middle;
        padding: 10px 12px;
        border-top:1px solid black;
    }
    .table tr{
    }
    .table{
        border-collapse:collapse;
    }
</style>