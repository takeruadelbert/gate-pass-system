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
class CalculatorHelper extends HtmlHelper {

    function calculateHour($start = null, $end = null) {
        $eStart = explode(":", $start);
        $eEnd = explode(":", $end);
        $eResult = [];
        $eResult[0] = $eEnd[0] - $eStart[0];
        $eResult[1] = $eEnd[1] - $eStart[1];
        if ($eResult[1] < 0) {
            $eResult[1]+=60;
            $eResult[0] --;
        }
        return $eResult[0] . " " . __("Jam") . " " . $eResult[1] . " " . __("Menit");
    }

}
