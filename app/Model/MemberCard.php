<?php

class MemberCard extends AppModel {

    public $validate = array(
        'card_number' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        )
    );
    public $belongsTo = array();
    public $hasOne = array(
    );
    public $hasMany = array(
    );
    public $virtualFields = array(
    );
    
}
