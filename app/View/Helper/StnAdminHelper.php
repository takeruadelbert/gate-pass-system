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
class StnAdminHelper extends HtmlHelper {

    function getOtherUrlName($url) {
        $parsedUrl = Router::parse($url);
        $controller = $parsedUrl["controller"];
        $prefix = $parsedUrl["prefix"];
        $action = str_replace_first($prefix . "_", "", $parsedUrl["action"]);
        if (!empty($controller)) {
            $camelController = Inflector::camelize($controller);
            $underController = Inflector::underscore($controller);
            $otherController = Inflector::variable(Inflector::pluralize($camelController));
            $reversedUrl = Router::url([
                        "controller" => $underController,
                        "action" => $action,
                        "prefix" => $prefix,
            ]);
            $reversedUrl = str_replace_first(Router::url("/"), "", $reversedUrl);
            if ($action == "index") {
                $urls = [
                    "{$prefix}/{$camelController}/index",
                    "{$prefix}/{$underController}/index",
                    "{$prefix}/{$otherController}/index",
                    "{$prefix}/{$camelController}",
                    "{$prefix}/{$underController}",
                    "{$prefix}/{$otherController}",
                ];
            } else {
                $urls = [
                    "{$prefix}/{$camelController}/{$action}",
                    "{$prefix}/{$underController}/{$action}",
                    "{$prefix}/{$otherController}/{$action}",
                ];
            }
            $urls[] = $reversedUrl;
            return $urls;
        }
        return [];
    }

    function is($user_group_needles = array(), $credential = null) {
        $user_groups = ClassRegistry::init("UserGroup")->find("all", array(
            "conditions" => array(
                "OR" => array(
                    "UserGroup.id" => $user_group_needles,
                    "UserGroup.name" => $user_group_needles,
                ),
            ),
            "fields" => array(
                "UserGroup.id",
                "UserGroup.name",
            ),
            "recursive" => -1
        ));
        $user_group_ids = array();
        $user_group_names = array();
        foreach ($user_groups as $user_group) {
            $user_group_ids[] = $user_group["UserGroup"]["id"];
            $user_group_names[] = $user_group["UserGroup"]["name"];
        }
        return in_array($credential['User']['user_group_id'], $user_group_ids);
    }

    function copyrightYear($start = null) {
        $now = date("Y");
        if ($now <= $start) {
            return $start;
        }
        return "$start - $now";
    }

}
