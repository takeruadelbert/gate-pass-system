<?php

class ModuleLink extends AppModel {

    var $name = 'ModuleLink';
    var $actsAs = array('Containable');
    var $validate = array(
        'alias' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus diisi'
        ),
    );
    var $belongsTo = array(
        'Module',
    );
    var $hasMany = array(
    );
    var $virtualFields = array(
    );

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
