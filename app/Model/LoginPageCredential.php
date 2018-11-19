<?php

class LoginPageCredential extends AppModel {

    var $name = 'LoginPageCredential';
    var $belongsTo = array(
        'LoginPage',
        "UserGroup",
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        
    );
    var $validate = array(
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
