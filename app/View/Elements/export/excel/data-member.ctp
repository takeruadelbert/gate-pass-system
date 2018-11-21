<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Data Gate
    </div>
    <?php
    if (!empty($this->request->query['awal_Member_expired_dt']) && !empty($this->request->query['akhir_Member_expired_dt'])) {
        ?>
        <div style="font-size:11px;font-style: italic; font-family:Tahoma, Geneva, sans-serif;">Periode : <?= $this->Echo->laporanPeriodeBulan(@$this->request->query['awal_Member_expired_dt'], @$this->request->query['akhir_Member_expired_dt']) ?></div>
        <?php
    } else {
        ?>
        <div style="font-size:11px;font-style: italic; font-family:Tahoma, Geneva, sans-serif;">Periode : - </div>
        <?php
    }
    ?>     
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("UID") ?></th>
            <th><?= __("Nama") ?></th>
            <th><?= __("Expired Date") ?></th>
            <th><?= __("Akses Gate") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan = 5>Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td class="text-center"><?= $item['Member']['uid'] ?></td>
                    <td class="text-center"><?= $item['Member']['name'] ?></td>
                    <td class="text-center"><?= $this->Html->cvtWaktu($item['Member']['expired_dt']) ?></td>
                    <td>
                        <ul>
                            <?php
                            if (!empty($item['MemberDetail'])) {
                                foreach ($item['MemberDetail'] as $detail) {
                                    ?>
                                    <li><?= $detail['Gate']['full_label'] ?></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>