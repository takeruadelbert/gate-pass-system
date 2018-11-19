<?php

class City extends AppModel {

    var $name = 'City';
    var $belongsTo = array(
        "CityStatus"
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
    );
    var $virtualFields = array(
        "label"=>"select concat(CityStatus.name,' ',City.name) from city_statuses CityStatus where CityStatus.id=City.city_status_id"
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
