<?php


class Client extends AppModel
{
    public $validate = array(
        'name' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah Ada' => array("rule" => 'isUnique')
        )
    );
    public $belongsTo = array();
    public $hasOne = array();
    public $hasMany = array(
        "Gate" => [
            "dependent" => TRUE
        ],
        "Member" => [
            "dependent" => TRUE
        ]
    );
}