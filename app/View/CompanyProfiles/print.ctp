<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th><?= __("Username") ?></th>
            <th><?= __("Nama Depan") ?></th>
            <th><?= __("Nama Belakang") ?></th>
            <th><?= __("Alamat") ?></th>
            <th><?= __("No. Handphone") ?></th>
            <th><?= __("Status Pengguna") ?></th>
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
                <td><?= $item['User']['username'] ?></td>
                <td><?= $item['Biodata']['first_name'] ?></td>
                <td><?= $item['Biodata']['last_name'] ?></td>
                <td><?= $item['Biodata']['address'] ?></td>
                <td><?= $item['Biodata']['handphone'] ?></td>
                <td><?= $item['AccountStatus']['name'] ?></td>
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