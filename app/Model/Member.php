<?php

class Member extends AppModel {

    public $validate = array(
        'uid' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah Terdaftar' => array("rule" => 'isUnique')
        ),
        'expired_dt' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        )
    );
    public $belongsTo = array(
    );
    public $hasOne = array(
    );
    public $hasMany = array(
        "MemberCard" => [
            "dependent" => TRUE
        ]
    );
    public $virtualFields = array(
    );
    
    function is_member_exists($uid = null) {
        if(!empty($uid)) {
            $data = $this->find("first",[
                "conditions" => [
                    "Member.uid" => $uid
                ],
                "recursive" => -1
            ]);
            return !empty($data) ? TRUE : FALSE;
        }
    }
}
