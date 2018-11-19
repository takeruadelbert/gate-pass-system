<?php

App::uses('AppController', 'Controller');

class MenusController extends AppController {

    var $name = "Menus";
    var $disabledAction = array(
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("modules", $this->Menu->Module->find("list", ["fields" => ["Module.id", "Module.name"], "order" => "Module.name"]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_index() {
        $this->contain = [
            "Module",
        ];
        parent::admin_index();
    }
}
