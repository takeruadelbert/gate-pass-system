<?php

class MemberCard extends AppModel
{

    public $validate = array(
        'card_number' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        ),
        'expired_dt' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        ),
    );
    public $belongsTo = array(
        "Member"
    );
    public $hasOne = array();
    public $hasMany = array();
    public $virtualFields = array();
    public static $statusBanned = "BANNED";
}
