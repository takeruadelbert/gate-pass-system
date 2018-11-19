<?php

class AssetFile extends AppModel {

    public $validate = array(
    );
    public $belongsTo = array(
    );
    public $hasMany = array(
    );
    public $hasOne = array(
    );

    function beforeSave($options = array()) {
        if ($this->id == null) {
            $token = hash("sha224", uniqid(mt_rand(), true), false);
            $this->data['AssetFile']['token'] = $token;
        }
        return true;
    }

}
