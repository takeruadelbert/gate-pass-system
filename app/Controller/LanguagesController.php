<?php

App::uses('AppController', 'Controller');

class LanguagesController extends AppController {

    var $name = "Languages";
    var $disabledAction = array(
        "admin_index",
        "admin_add",
        "admin_edit",
        "admin_delete",
        "admin_multiple_delete",
    );

    function beforeFilter() {
        parent::beforeFilter();
    }

    function admin_change($lang = null) {
        if ($this->Language->hasAny(array("code"=>$lang))){
            $this->Session->write("Config.language",$lang);
        }
        $this->redirect($this->referer());
    }

}
