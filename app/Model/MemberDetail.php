<?php

class MemberDetail extends AppModel {

    public $validate = array(
        'gate_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus Dipilih.'
        )
    );
    public $belongsTo = array(
        "Gate"
    );
    public $hasOne = array(
    );
    public $hasMany = array(
    );
    public $virtualFields = array(
    );
    
}
