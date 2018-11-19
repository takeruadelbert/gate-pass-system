<?php

class UsersController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data User");
        $this->_setPageInfo("admin_add", "Tambah User");
        $this->_setPageInfo("admin_edit", "Edit User");
    }

}
