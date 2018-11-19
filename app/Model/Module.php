<?php

class Module extends AppModel {

    var $name = 'Module';
    
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        "ModuleLink" => array(
            "dependent" => true
        ),
        "Menu" => array(
            "dependent" => true
        ),
    );
    var $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'alias' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
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
