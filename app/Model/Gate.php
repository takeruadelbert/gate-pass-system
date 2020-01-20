<?php

class Gate extends AppModel {

    public $validate = array(
        'name' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah Ada' => array("rule" => 'isUnique')
        ),
        'ip_address' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah Ada' => array("rule" => 'isUnique')
        ),
        'gate_type_id' => array(
            'rule' => 'NotBlank',
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

    function get_list_gate($conds = []) {
        return $this->find("list",[
            "conditions" => [
                $conds
            ],
            "fields" => [
                "Gate.id",
                "Gate.full_label"
            ],
            "recursive" => -1,
            "order" => "Gate.gate_type_id"
        ]);
    }
    
    function get_list_gate_by_type() {
        // fetch all gate in
        $dataGateIn = $this->find("list",[
            'conditions' => [
                'Gate.gate_type_id' => 1
            ],
            "fields" => [
                "Gate.id",
                "Gate.full_label"
            ],
            "recursive" => -1,
            "order" => "Gate.name"
        ]);
        $gate_in = [];
        if(!empty($dataGateIn)) {
            $temp = [];
            foreach ($dataGateIn as $gate_id => $gate_name) {
                $temp[$gate_id] = $gate_name;
            }
            $gate_in = [
                "Gate Masuk" => $temp
            ];
        }
        
        // fetch all gate out
        $dataGateOut = $this->find("list",[
            "conditions" => [
                "Gate.gate_type_id" => 2
            ],
            "fields" => [
                "Gate.id",
                "Gate.full_label"
            ],
            "recursive" => -1,
            "order" => "Gate.name"
        ]);
        $gate_out = [];
        if(!empty($dataGateOut)) {
            $temp = [];
            foreach ($dataGateOut as $gate_id => $gate_name) {
                $temp[$gate_id] = $gate_name;
            }
            $gate_out = [
                "Gate Keluar" => $temp
            ];
        }
        $gates = $gate_in + $gate_out;
        return $gates;
    }
    
    function get_all_ids() {
        return $this->find("list",[
            "fields" => [
                "Gate.id",
                "Gate.id"
            ],
            "recursive" => -1,
            "order" => "Gate.name"
        ]);
    }
    
    function get_gate_name($gate_id = null) {
        if(!empty($gate_id)) {
            $gate = $this->find("first",[
                "conditions" => [
                    "Gate.id" => $gate_id
                ],
                "recursive" => -1
            ]);
            return !empty($gate) ? $gate['Gate']['full_label'] : "";
        }
    }
    
    function get_ip_address($gate_id = null) {
        if(!empty($gate_id)) {
            $gate = $this->find("first",[
                "conditions" => [
                    "Gate.id" => $gate_id
                ],
                "recursive" => -1
            ]);
            return !empty($gate) ? $gate['Gate']['ip_address'] : "";
        }
    }
}
