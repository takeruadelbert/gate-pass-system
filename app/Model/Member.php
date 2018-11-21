<?php

class Member extends AppModel {

    public $validate = array(
        'uid' => array(
            'Harus diisi' => array("rule" => "notEmpty"),
            'Sudah Terdaftar' => array("rule" => 'isUnique')
        ),
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus Diisi.'
        ),
        'expired_dt' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus Diisi.'
        )
    );
    public $belongsTo = array(
    );
    public $hasOne = array(
    );
    public $hasMany = array(
        "MemberDetail" => [
            "dependent" => true
        ]
    );
    public $virtualFields = array(
    );
    
}
