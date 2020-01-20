<?php

App::uses('AppController', 'Controller');

class ModuleContentsController extends AppController {

    var $name = "ModuleContents";
    var $disabledAction=array(
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
}
