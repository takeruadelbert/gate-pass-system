<?php

App::uses('AppController', 'Controller');

class GatesController extends AppController {

    var $name = "Gates";
    var $disabledAction = array(
    );
    var $contain = array(
        "GateType"
    );

    function _options() {
        $this->set("gateTypes", ClassRegistry::init("GateType")->find("list", ['fields' => ['GateType.id', 'GateType.name'], 'recursive' => -1]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data-gate");
        parent::admin_index();
    }

    function admin_sync_data_gate($gate_id) {
        if (!empty($gate_id)) {
            $dataGate = $this->{Inflector::classify($this->name)}->find("first", [
                "conditions" => [
                    "Gate.id" => $gate_id
                ],
                "recursive" => -1
            ]);
            if (!empty($dataGate)) {
                $ip_address_gate = $dataGate['Gate']['ip_address'];
                if ($conn = @mysql_connect($ip_address_gate, $this->username, $this->password, $this->db_name)) {
                    $id = $dataGate['Gate']['id'];
                    $name = $dataGate['Gate']['name'];
                    $gate_type_id = $dataGate['Gate']['gate_type_id'];
                    $created = $dataGate['Gate']['created'];
                    $modified = $dataGate['Gate']['modified'];
                    $is_deleted = $dataGate['Gate']['is_deleted'];
                    $deleted_date = $dataGate['Gate']['deleted_date'];

                    // check if record exists
                    mysql_select_db($this->db_name);
                    $query = "SELECT * FROM gates WHERE ip_address = '$ip_address_gate'";
                    $temp = mysql_query($query);
                    if (mysql_fetch_array($temp) !== FALSE) {
                        $update_query = "UPDATE gates SET name = '$name', gate_type_id = '$gate_type_id', ip_address = '$ip_address_gate', created = '$created', "
                                . "modified = '$modified', is_deleted = '$is_deleted', deleted_date = '$deleted_date' WHERE ip_address = '$ip_address_gate'";
                        mysql_select_db($this->db_name);
                        if(mysql_query($update_query, $conn) == TRUE) {
                            echo "Successfully update record.";
                        } else {
                            echo "Failed to update record.";
                            $this->Session->setFlash(__("Failed to update record."), 'default', array(), 'danger');
                            return;
                        }
                    } else {
                        $insert_query = "INSERT INTO gates (name, gate_type_id, ip_address) VALUES ('$name', '$gate_type_id', '$ip_address_gate')";
                        mysql_select_db($this->db_name);
                        if (mysql_query($insert_query, $conn) === TRUE) {
                            echo "Successfully insert new record.";
                        } else {
                            echo "Failed to insert new record.";
                            $this->Session->setFlash(__("Failed to insert new record."), 'default', array(), 'danger');
                            return;
                        }
                    }
                    mysql_close($conn);
                    $this->Session->setFlash(__("Sync Berhasil."), 'default', array(), 'success');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->Session->setFlash(__("Sync Failed : Cannot connect to {$ip_address_gate} --> {$conn->connect_error}"), 'default', array(), 'danger');
                }
            } else {
                $this->Session->setFlash(__("Invalid Data Gate ID."), 'default', array(), 'danger');
            }
        } else {
            $this->Session->setFlash(__("Invalid Data Gate ID."), 'default', array(), 'danger');
        }
    }

}
