<?php

App::uses('AppController', 'Controller');

class PopupsController extends AppController {

    var $name = "Popups";
    var $disabledAction=array(
        "admin_index",
        "admin_add",
        "admin_edit"
    );
    
    function beforeFilter() {
        parent::beforeFilter();
    }
    
    function admin_content(){
        $this->set("content",$this->params->query['content']);
        $this->set("query",$this->params->query);
    }
}
