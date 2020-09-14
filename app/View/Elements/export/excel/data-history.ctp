<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Data History
    </div>
    <div style="font-size:11px;font-style: italic; font-family:Tahoma, Geneva, sans-serif;">Periode : <?= $this->Echo->laporanPeriodeTanggalWaktu(@$start_date, @$end_date) ?></div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("UID Card") ?></th>
            <th><?= __("Nama") ?></th>
            <th><?= __("Tangga/Waktu") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan = 4>Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td class="text-center"><?= $item['History']['code'] ?></td>
                    <td class="text-center"><?= $this->Echo->empty_strip(@$item['History']['name']) ?></td>
                    <td class="text-center"><?= $this->Html->cvtWaktu($item['History']['datetime']) ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>