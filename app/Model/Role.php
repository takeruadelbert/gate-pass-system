<?php

class Role extends AppModel {

    var $name = 'Role';
    var $actsAs = array('Containable');
    var $belongsTo = array(
        'UserGroup',
        'Menu',
    );
    var $hasOne = array(
    );
    var $validate = array(
    );
    var $virtualFields = array(
//        'modulePosition' => "SELECT position FROM modules WHERE id = Role.module_id",
//        'moduleOrder' => "SELECT ordering_number FROM modules WHERE id = Role.module_id"
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
