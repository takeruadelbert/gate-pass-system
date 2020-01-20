<?php

App::uses('AppController', 'Controller');

class UserGroupsController extends AppController {

    var $name = "UserGroups";
    var $disabledAction=array(
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "User Group");
        $this->_setPageInfo("admin_add", "Tambah User Group");
        $this->_setPageInfo("admin_edit", "Ubah User Group");
    }
}
