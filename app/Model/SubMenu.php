<?php

class SubMenu extends AppModel {

    var $name = 'SubMenu';
    var $belongsTo = array(
        "Parent" => [
            "className" => "SubMenu"
        ],
        "Module",
        "Menu",
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        "RoleSubMenu" => [
            "dependent" => true,
        ],
    );
    var $validate = array(
        'label' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'menu_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus dipilih'
        ),
    );
    var $virtualFields = array(
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
