<?php

class Menu extends AppModel {

    var $name = 'Menu';
    var $belongsTo = array(
        "Module",
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        "SubMenu"=>[
            "dependent"=>true,
        ],
        "Role"=>[
            "dependent"=>true,
        ],
    );
    var $validate = array(
        'label' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'ordering_number' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'position' => array(
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
