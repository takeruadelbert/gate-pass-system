<?php

class Member extends AppModel {

    public $validate = array(
        'uid' => array(
            'Harus diisi' => array("rule" => "notEmpty"),
            'Sudah Terdaftar' => array("rule" => 'isUnique')
        ),
//        'name' => array(
//            'rule' => 'notEmpty',
//            'message' => 'Harus Diisi.'
//        ),
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
