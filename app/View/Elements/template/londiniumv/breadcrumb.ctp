<div class="breadcrumb-line">
    <ul class="breadcrumb" style="background-color:#a50000 !important">
        <li><a href="<?php echo Router::url("/admin/dashboard") ?>">Dashboard</a></li>
        <?php
        switch ($url) {
            case "admin/employees/profil":
                ?>
                <li><a href="<?php echo Router::url("/admin/employees/profil") ?>">Profil Anda</a></li>
                <?php
                break;
            case "admin/accounts/change_password":
                ?>
                <li><a href="<?php echo Router::url("/admin/accounts/change_password") ?>">Ganti Kata Sandi</a></li>
                <?php
                break;
        }
        $bcSuggestion = array_reverse($bcSuggestion);
        foreach ($bcSuggestion as $bc) {
            if (empty($bc['alias'])) {
                echo "<li style='color:lightgray'>{$bc['label']}</li>";
            } else {
                echo "<li><a href='" . Router::url("/" . $bc['alias'], true) . "' class=''>{$bc['label']}</a></li>";
            }
        }
        ?>
    </ul>
    <ul class="breadcrumb-buttons" style="background-color:#a50000 !important">
        <li class="dropdown" style="padding:9px 25px 10px;margin-top:5px">
            <div class="" style="color:white"><i class="icon-clock3"></i>&nbsp;&nbsp;<span id="targetDigitalTime"></span></div>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function () {
        var liveClock = function (servertime) {
            var currDateTime = servertime;
            var formattedDate = function (date) {
                var day = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                var month = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
                var dayN = String(currDateTime.getDay());
                var dd = day[dayN];
                var mthN = String(currDateTime.getMonth());
                var mth = month[mthN];
                var mthday = String(currDateTime.getDate());
                //return sprintf('%02d', (date.getMonth()+1))+'-'+sprintf('%02d', date.getDate())+'-'+sprintf('%02d', date.getFullYear())+' '+sprintf('%02d', date.getHours())+':'+sprintf('%02d', date.getMinutes())+':'+sprintf('%02d', date.getSeconds());    
                return dd + ", " + sprintf('%02d', mthday) + " " + mth + " " + ' ' + date.getFullYear() + ' ' + sprintf('%02d', date.getHours()) + ':' + sprintf('%02d', date.getMinutes()) + ':' + sprintf('%02d', date.getSeconds());
            };
            var setDateTime = function () {
                currDateTime.setSeconds(currDateTime.getSeconds() + 1);
                $("#targetDigitalTime").html(formattedDate(currDateTime));
                return false;
            };
            var everySec = setInterval(setDateTime, 1000);
        };
        var servertime = new Date('<?php print date("F d, Y H:i:s"); ?>');
        liveClock(servertime);

    });
</script>