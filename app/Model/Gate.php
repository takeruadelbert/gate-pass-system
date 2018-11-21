<?php

class Gate extends AppModel {

    public $validate = array(
        'name' => array(
            'Harus diisi' => array("rule" => "notEmpty"),
            'Sudah Ada' => array("rule" => 'isUnique')
        ),
        'ip_address' => array(
            'Harus diisi' => array("rule" => "notEmpty"),
            'Sudah Ada' => array("rule" => 'isUnique')
        ),
        'gate_type_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus Dipilih.'
        )
    );
    public $belongsTo = array(
        "GateType"
    );
    public $hasOne = array(
    );
    public $virtualFields = array(
        "full_label" => "concat(Gate.name, ' - ', Gate.ip_address)",
    );

    function get_list_gate() {
        return $this->find("list",[
            "fields" => [
                "Gate.id",
                "Gate.full_label"
            ],
            "recursive" => -1,
            "order" => "Gate.gate_type_id"
        ]);
    }
    
}
