<?php

class UserGroup extends AppModel {

    var $name = 'UserGroup';
    var $actsAs = array('Containable');
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        "Role",
        "LoginPageCredential",
    );
    var $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => 'isUnique',
                'message' => 'Nama telah terpakai',
            ),
            'rule2' => array(
                'rule' => 'notEmpty',
                'message' => 'Harus diisi',
            )
        )
    );
    var $virtualFields = array(
    );
    public $excludedUserGroup = [
        "admin",
    ];

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

    function excludedUserGroup() {
        return $this->find("list", [
                    "conditions" => [
                        "UserGroup.name" => $this->excludedUserGroup,
                    ],
                    "fields" => [
                        "UserGroup.id",
                    ],
        ]);
    }

}

?>
