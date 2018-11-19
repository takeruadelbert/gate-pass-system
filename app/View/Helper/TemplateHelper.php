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
class TemplateHelper extends HtmlHelper {

    var $src = array(
        "londium" => array(
            "js" => array(
                "jquery.min.js",
                "jquery-ui.min.js",
                "plugins/charts/sparkline.min.js",
                "plugins/forms/uniform.min.js",
                "plugins/forms/select2.min.js",
                "plugins/forms/inputmask.js",
                "plugins/forms/autosize.js",
                "plugins/forms/inputlimit.min.js",
                "plugins/forms/listbox.js",
                "plugins/forms/multiselect.js",
                "plugins/forms/validate.min.js",
                "plugins/forms/tags.min.js",
                "plugins/forms/switch.min.js",
                "plugins/forms/uploader/plupload.full.min.js",
                "plugins/forms/uploader/plupload.queue.min.js",
                "plugins/forms/wysihtml5/wysihtml5.min.js",
                "plugins/forms/wysihtml5/toolbar.js",
                "plugins/interface/daterangepicker.js",
                "plugins/interface/fancybox.min.js",
                "plugins/interface/moment.js",
//                "plugins/interface/jgrowl.min.js",
                "plugins/interface/datatables.min.js",
                "plugins/interface/colorpicker.js",
                "plugins/interface/fullcalendar.min.js",
                "plugins/interface/timepicker.min.js",
                "plugins/interface/collapsible.min.js",
                "bootstrap.min.js",
                "application.js",
                "custom-functions.js",
            ),
            "css" => array(
                "bootstrap.min.css",
                "londinium-theme.css",
                "styles.css",
                "icons.css",
                "app.css",
            ),
            "custom" => array(
//				array(
//					"url"=>"http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js",
//					"type"=>"js",
//				),
                array(
                    "url" => "https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext",
                    "type" => "css",
                ),
            ),
            "content" => ".page-content",
        ),
        "pages-ace" => array(
            "assets/js" => array(
                "../plugins/pace/pace.min.js",
                "../plugins/jquery/jquery-1.11.1.min.js",
                "../plugins/modernizr.custom.js",
                "../plugins/jquery-ui/jquery-ui.min.js",
                "../plugins/boostrapv3/js/bootstrap.min.js",
                "../plugins/jquery/jquery-easy.js",
                "../plugins/jquery-unveil/jquery.unveil.min.js",
                "../plugins/jquery-bez/jquery.bez.min.js",
                "../plugins/jquery-ios-list/jquery.ioslist.min.js",
                "../plugins/jquery-actual/jquery.actual.min.js",
                "../plugins/jquery-scrollbar/jquery.scrollbar.min.js",
                "../plugins/bootstrap-select2/select2.min.js",
                "../plugins/classie/classie.js",
                "../plugins/switchery/js/switchery.min.js",
                "../plugins/jquery-datatable/media/js/jquery.dataTables.min.js",
                "../plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js",
                "../plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js",
                "../plugins/jquery-datatable/media/js/jquery.dataTables.js",
                "../plugins/moment/moment.min.js",
                "../plugins/moment/moment-with-locales.min.js",
                "../plugins/imagesloaded/imagesloaded.pkgd.min.js",
                "../plugins/datatables-responsive/js/datatables.responsive.js",
                "../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js",
                "../plugins/dropzone/dropzone.min.js",
                "../plugins/summernote/js/summernote.min.js",
                "../plugins/bootstrap-timepicker/bootstrap-timepicker.min.js",
                "scripts.js",
            ),
            "pages/js" => array(
                "pages.calender.min.js",
                "pages.email.js",
                "pages.js",
                "pages.social.min.js",
            ),
            "assets/css" => array(
                "style.css",
                "style.min.css",
                "../plugins/pace/pace-theme-flash.css",
                "../plugins/boostrapv3/css/bootstrap.min.css",
                "../plugins/font-awesome/css/font-awesome.css",
                "../plugins/jquery-scrollbar/jquery.scrollbar.css",
                "../plugins/bootstrap-select2/select2.css",
                "../plugins/switchery/css/switchery.min.css",
                "../plugins/jquery-datatable/media/css/jquery.dataTables.css",
                "../plugins/bootstrap-datepicker/css/datepicker3.css",
                "../plugins/dropzone/css/dropzone.css",
                "../plugins/summernote/css/summernote.css",
                "../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css",
            ),
            "pages/css" => array(
                "editor.css",
                "ie9.css",
                "pages-icons.css",
                "windows.chrome.fix.css",
                "pages.min.css",
                "customs.css",
            ),
            "content" => ".page-content",
        ),
        "londiniumv" => array(
            "js" => array(
                "jquery.min.js",
                "jquery-ui.min.js",
                "moment-with-locales.min.js",
                "plugins/charts/sparkline.min.js",
                "plugins/forms/uniform.min.js",
                "plugins/forms/select2.min.js",
                "plugins/forms/inputmask.js",
                "plugins/forms/autosize.js",
                "plugins/forms/inputlimit.min.js",
                "plugins/forms/listbox.js",
                "plugins/forms/multiselect.js",
                "plugins/forms/validate.min.js",
                "plugins/forms/tags.min.js",
                "plugins/forms/switch.min.js",
                "plugins/forms/uploader/plupload.full.min.js",
                "plugins/forms/uploader/plupload.queue.min.js",
                "plugins/forms/wysihtml5/wysihtml5.min.js",
                "plugins/forms/wysihtml5/toolbar.js",
                "plugins/forms/typeahead.bundle.min.js",
                "plugins/interface/daterangepicker.js",
                "plugins/interface/fancybox.min.js",
//                "plugins/interface/moment.js",
//                "moment-with-locales.min.js",
//                "plugins/interface/jgrowl.min.js",
                "plugins/interface/jquery.growl.js",
                "plugins/interface/datatables.min.js",
                "plugins/interface/colorpicker.js",
                "plugins/interface/fullcalendar.js",
                "plugins/interface/timepicker.min.js",
                "plugins/interface/collapsible.min.js",
                "bootstrap.min.js",
                "bootstrap-material-datetimepicker.js",
                "application.js",
                "custom-functions.js",
                "nprogress.js",
                "app.js",
            ),
            "css" => array(
                "bootstrap.min.css",
                "londinium-theme.min.css",
                "styles.min.css",
                "icons.css",
                "typeaheadjs",
                "app.css",
                "bootstrap-material-datetimepicker.css",
                "jquery.growl.css",
                "nprogress.css",
            ),
            "custom" => array(
                array(
                    "url" => "https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext",
                    "type" => "css",
                ),
            ),
            "content" => ".page-content",
        ),
    );
    var $jsDefault = array(
        "functions.js",
        "plugin/mustache.js",
        "plugin/jquery.datetimepicker.full.js",
        "plugin/jquery.number.min.js",
        "plugin/purl.js",
        "ckeditor/ckeditor.js",
        "menumapping.js",
    );
    var $cssDefault = array(
        "flag-icon/css/flag-icon.min.css",
        "jquery.datetimepicker.css",
    );

    function import($exception = array()) {
        global $URL, $ACTION_URL,$MID;
        $name = Configure::read("template");
        if (!is_null($name) || isset($this->src[$name])) {
            foreach ($this->src[$name] as $k => $c) {
                if (strpos($k, "js") !== false) {
                    foreach ($c as $js) {
                        $parentFolder = rtrim($k, 'js');
                        if (!in_array($js, $exception)) {
                            echo $this->script("/" . _TEMPLATE_DIR . "/{$name}/{$parentFolder}js/{$js}");
                        }
                    }
                } else if (strpos($k, "css") !== false) {
                    foreach ($c as $css) {
                        $parentFolder = rtrim($k, "css");
                        if (!in_array($css, $exception)) {
                            echo $this->css("/" . _TEMPLATE_DIR . "/{$name}/{$parentFolder}css/{$css}");
                        }
                    }
                } else if ($k == "custom") {
                    foreach ($c as $item) {
                        switch ($item['type']) {
                            case "js":
                                if (!in_array($item['url'], $exception)) {
                                    echo $this->script($item['url']);
                                }
                                break;
                            case "css":
                                if (!in_array($item['url'], $exception)) {
                                    echo $this->css($item['url']);
                                }
                                break;
                        }
                    }
                }
            }
            foreach ($this->jsDefault as $js) {
                if (!in_array($js, $exception)) {
                    echo $this->script("/js/{$js}");
                }
            }
            foreach ($this->cssDefault as $css) {
                if (!in_array($css, $exception)) {
                    echo $this->css("/css/{$css}");
                }
            }
            echo "<script> var BASE_URL='" . Router::url("/", true) . "'; var CONTENT_SELECTOR = '{$this->src[$name]['content']}';var URL='{$URL}';var ACTION_URL='{$ACTION_URL}';var PREFIX='{$this->params['prefix']}';var CONTROLLER='{$this->params['controller']}';var TEMPLATE='{$name}';var MID='{$MID}'</script>";
        } else {
            die("Invalid template");
        }
    }

    function img($url = null, array $options = array()) {
        $name = Configure::read("template");
        echo $this->image(Router::url("/", true) . _TEMPLATE_DIR . "/$name/$url", $options);
    }

}
