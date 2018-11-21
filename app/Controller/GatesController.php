<?php

App::uses('AppController', 'Controller');

class GatesController extends AppController {

    var $name = "Gates";
    var $disabledAction=array(
    );
    var $contain = array(
        "GateType"
    );
    
    function _options() {
        $this->set("gateTypes", ClassRegistry::init("GateType")->find("list", ['fields' => ['GateType.id', 'GateType.name'], 'recursive' => -1]));
    }
    
    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "data-gate");
        parent::admin_index();
    }
}
