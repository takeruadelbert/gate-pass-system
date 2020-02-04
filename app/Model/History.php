<?php


class History extends AppModel
{
    public $validate = array(
        "code" => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        ),
        "datetime" => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        ),
        "gate_id" => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Dipilih.'
        )
    );
    public $belongsTo = array();
    public $hasOne = array();
}