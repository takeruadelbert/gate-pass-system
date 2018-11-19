<?php

class LoginPage extends AppModel {

    var $name = 'LoginPage';
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        'LoginPageCredential'
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
