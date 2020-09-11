<?php

class Member extends AppModel {

    public $validate = array(
        'client_id' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Dipilih.'
        ),
    );
    public $belongsTo = array(
        "Client"
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
}
