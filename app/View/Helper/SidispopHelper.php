<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class SidispopHelper extends HtmlHelper {

    function tempatLahir($biodata = false) {
        if ($biodata) {
            return $biodata['tempat_lahir_kota'] . " - " . $biodata['tempat_lahir_provinsi'];
        }
        return "-";
    }

    function nipDispositor($mailRecipient = null) {
        if (is_null($mailRecipient) || !isset($mailRecipient['MailRecipient'])) {
            return "-";
        } else if (is_null($mailRecipient['MailRecipient']['dispositor_id'])) {
            return "[mailroom]";
        } else {
            return $mailRecipient["Dispositor"]['nip_baru'];
        }
    }

    function namaDispositor($mailRecipient = null) {
        if (is_null($mailRecipient) || !isset($mailRecipient['MailRecipient'])) {
            return "-";
        } else if (is_null($mailRecipient['MailRecipient']['dispositor_id'])) {
            return "[mailroom]";
        } else {
            return $mailRecipient["Dispositor"]['Account']["Biodata"]["full_name"];
        }
    }

    function nipDiteruskan($mailRecipient = null) {
        if (is_null($mailRecipient) || !isset($mailRecipient['MailRecipient'])) {
            return "-";
        } else {
            return $mailRecipient["Employee"]['nip_baru'];
        }
    }

    function namaDiteruskan($mailRecipient = null) {
        if (is_null($mailRecipient) || !isset($mailRecipient['MailRecipient'])) {
            return "-";
        } else {
            return $mailRecipient["Employee"]['Account']["Biodata"]["full_name"];
        }
    }

    function tandaTangan($titlePosition = "center") {
        $data = ClassRegistry::init("EntityConfiguration")->find("first");
        ?>
        <div class="text-<?= $titlePosition ?>">Kepala Dinas,</div>
        <br/><br/><br/>
        <p style="text-decoration:underline"><b><?= $data['EntityConfiguration']['kepala_dinas'] ?></b></p>
        <p>NIP : <?= $data['EntityConfiguration']['nip_kepala_dinas'] ?></p>
        <?php
    }

    function tandaTanganSekretaris($titlePosition = "center") {
        $data = ClassRegistry::init("Employee")->find("first", [
            "conditions" => [
                "Office.uniq" => "sekre",
            ],
            "contain" => [
                "Account" => [
                    "Biodata",
                ],
                "Office"
            ]
        ]);
        ?>
        <div class="text-<?= $titlePosition ?>">Sekretaris Dinas,</div>
        <br/><br/><br/>
        <p style="text-decoration:underline"><b><?= $data['Account']['Biodata']['full_name'] ?></b></p>
        <p>NIP : <?= $data['Employee']['nip_baru'] ?></p>
        <?php
    }

    function hariIni() {
        ?>
        <p>Mamuju, <?= $this->cvtTanggal(null, true)?></p>
        <?php
    }

}
