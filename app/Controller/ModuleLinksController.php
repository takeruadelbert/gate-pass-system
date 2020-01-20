<?php

App::uses('AppController', 'Controller');

class ModuleLinksController extends AppController {

    var $disabledAction = array(
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Link Menu");
        $this->_setPageInfo("admin_add", "Tambah Link Menu");
        $this->_setPageInfo("admin_edit", "Ubah Link Menu");
    }

    function beforeRender() {
        parent::beforeRender();
        $this->_options();
    }

    function _options() {
        $this->set("moduleContents", $this->{ Inflector::classify($this->name) }->ModuleContent->find("list", array(
                    "fields" => array(
                        "ModuleContent.id", "ModuleContent.name", "Module.name"
                    ),
                    "recursive" => 1
        )));
        $this->set("modules", $this->{ Inflector::classify($this->name) }->Module->find("list", array(
                    "fields" => array(
                        "Module.id", "Module.name"
                    ),
                    "recursive" => 1
        )));
    }

    function admin_index() {
        $this->contain = array(
            "ModuleContent",
            "Module",
        );
        $this->_options();
        parent::admin_index();
    }

}
