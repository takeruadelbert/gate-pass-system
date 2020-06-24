<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'Api');

class MembersController extends AppController
{

    var $name = "Members";
    var $disabledAction = array();
    var $contain = array(
        "Client"
    );
    private $urlPath = "/api/member/";

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options()
    {
        $this->set("clients", ClassRegistry::init("Client")->find("list", ['fields' => ['Client.id', 'Client.name'], 'recursive' => -1]));
    }

    function beforeRender()
    {
        $this->_options();
        parent::beforeRender();
    }

    function admin_multi_add()
    {
        if ($this->request->is("post")) {
            $this->{Inflector::classify($this->name)}->set($this->data);
            if ($this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('validate' => 'only', "deep" => true))) {
                unset($this->{Inflector::classify($this->name)}->data['Member']['input-addon-checkbox']);
                if (!empty($this->{Inflector::classify($this->name)}->data['Member'])) {
                    foreach ($this->{Inflector::classify($this->name)}->data['Member'] as $i => $member) {
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['uid'] = $member['Member']['uid'];
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['name'] = $member['Member']['name'];
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['expired_dt'] = $member['Member']['expired_dt'];
                        $this->{Inflector::classify($this->name)}->data[$i]['MemberCard'] = $this->{Inflector::classify($this->name)}->data['MemberCard'];
                    }
                }
                unset($this->{Inflector::classify($this->name)}->data['Member']);
                unset($this->{Inflector::classify($this->name)}->data['MemberCard']);
                $this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('deep' => true));
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{Inflector::classify($this->name)}->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        } else {
            $this->set("gate_ids", ClassRegistry::init("Gate")->get_all_ids());
        }
    }

    function admin_index()
    {
        $this->_activePrint(func_get_args(), "data-member");
        parent::admin_index();
    }

    function admin_sync_data_member()
    {
        $this->set("dataClient", ClassRegistry::init("Client")->find("all", ['contain' => ['Gate']]));
    }

    function admin_sync_data_member_gate($gate_id = null)
    {
        if (!empty($gate_id)) {
            $dataGate = ClassRegistry::init("Gate")->find("first", [
                'fields' => [
                    'Gate.id',
                    'Gate.ip_address',
                    'Gate.client_id',
                    'Gate.name',
                    "Client.id",
                    "Client.name"
                ],
                'recursive' => -1,
                'conditions' => [
                    'Gate.id' => $gate_id
                ],
                "contain" => [
                    "Client"
                ]
            ]);
            $dataClient = ClassRegistry::init("Client")->find("all", [
                "conditions" => [
                    "Client.id" => $dataGate['Gate']['client_id']
                ],
                "contain" => [
                    "Member" => [
                        "fields" => [
                            "Member.id",
                            "Member.name",
                            "Member.client_id"
                        ],
                        "MemberCard" => [
                            "fields" => [
                                "MemberCard.id",
                                "MemberCard.card_number",
                                "MemberCard.expired_dt"
                            ]
                        ]
                    ]
                ],
                "fields" => [
                    "Client.id",
                    "Client.name"
                ]
            ]);
            $ipAddress = $dataGate['Gate']['ip_address'];
            $url = sprintf("%s%s", $ipAddress, $this->urlPath);

            // get data Member Card
            $param = [];
            if (!empty($dataClient)) {
                foreach ($dataClient as $client) {
                    if (!empty($client['Member'])) {
                        foreach ($client['Member'] as $member) {
                            foreach ($member['MemberCard'] as $detail) {
                                $param[] = [
                                    "code" => $detail['card_number'],
                                    "expiration" => $detail['expired_dt']
                                ];
                            }
                        }
                    }
                }
            }
            $header = [
                sprintf("%s: %s/%s", "Sync-Target", $dataGate['Client']['name'], $dataGate['Gate']['name'])
            ];
            $response = ApiController::apiPut($url, $param, $header);
            if ($response['http_response_code'] == 200) {
                $this->Session->setFlash(__("Sync to {$ipAddress} Success."), 'default', array(), 'success');
            } else {
                $this->Session->setFlash(__($response['body_response']), 'default', array(), 'warning');
            }
        } else {
            $this->Session->setFlash(__("Invalid Gate ID"), 'default', array(), 'warning');
        }
        $this->redirect(Router::url('/sync-data-member', true));
    }

//    function admin_sync_data_member_gate($gate_id = null)
//    {
//        $view = new View($this);
//        $helper = $view->loadHelper("App");
//        if (!empty($gate_id)) {
//            if ($this->request->is("POST")) {
//                $gate_id = $this->data['Member']['gate_id'];
//                try {
//                    // Raspberry Pi Data Processed
//                    $dataSaveRPI = isset($this->data['RPI']) ? $this->data['RPI'] : [];
//                    $ip_address_gate = ClassRegistry::init("Gate")->get_ip_address($gate_id);
//                    if (!empty($dataSaveRPI)) {
//                        $data_saved_rpi = [];
//                        if ($conn = @mysql_connect($ip_address_gate, $this->username, $this->password, $this->db_name)) {
//                            foreach ($dataSaveRPI as $dataRPI) {
//                                $temp = explode(" -- ", $dataRPI);
//                                $name = mysql_real_escape_string($temp[1]);
//                                $uid = mysql_real_escape_string($temp[2]);
//                                $expired_dt = mysql_real_escape_string($helper->convertDateFormat($temp[3]));
//
//                                // check if record exists
//                                mysql_select_db($this->db_name);
//                                $temp = mysql_query("SELECT * FROM members WHERE uid = '$uid'");
//                                if (mysql_fetch_array($temp) !== FALSE) {
////                                    debug("exists");
//                                } else {
//                                    // insert member record
//                                    $sql = "INSERT INTO members (name, uid, expired_dt) VALUES ('$name', '$uid', '$expired_dt')";
//                                    mysql_select_db($this->db_name);
//                                    if (mysql_query($sql, $conn) === TRUE) {
//                                        echo "successfully insert new record";
//                                    } else {
//                                        echo "failed to insert new record";
//                                    }
//
//                                    // insert member detail record
//                                    $sql = "INSERT INTO member_details (member_id, gate_id) VALUES (LAST_INSERT_ID(), '$gate_id')";
//                                    if (mysql_query($sql, $conn) === TRUE) {
//                                        echo "successfully insert new record";
//                                    } else {
//                                        echo "failed to insert new record";
//                                    }
//                                }
//                            }
//                            mysql_close($conn);
//                            $this->Session->setFlash(__("Sync Berhasil."), 'default', array(), 'success');
//                        } else {
//                            $this->Session->setFlash(__("Sync Failed : Cannot connect to {$ip_address_gate} --> {$conn->connect_error}"), 'default', array(), 'danger');
//                            $this->redirect(array('action' => 'admin_sync_data_member'));
//                        }
//                    } else {
//                        $this->Session->setFlash(__("No Changes Data."), 'default', array(), 'info');
//                    }
//
//                    // Local Data Processed
//                    $dataSaveLocal = isset($this->data['Local']) ? $this->data['Local'] : [];
//                    if (!empty($dataSaveLocal)) {
//                        $data_saved_local = [];
//                        foreach ($dataSaveLocal as $dataLocal) {
//                            $temp = explode(" -- ", $dataLocal);
//                            $name = !empty($temp[1]) ? $temp[1] : NULL;
//                            $uid = $temp[2];
//                            $expired_dt = $temp[3];
//
//                            // check if uid is already exist in database. if so, then ignore it, otherwise save it.
//                            if (!$this->{Inflector::classify($this->name)}->is_member_exists($uid)) {
//                                $data_saved_local[] = [
//                                    "Member" => [
//                                        "uid" => $uid,
//                                        "name" => @$name,
//                                        "expired_dt" => $helper->convertDateFormat($expired_dt)
//                                    ],
//                                    "MemberCard" => [
//                                        0 => [
//                                            "gate_id" => $gate_id
//                                        ]
//                                    ]
//                                ];
//                            }
//                        }
//
//                        // saving new record
//                        try {
//                            $this->{Inflector::classify($this->name)}->saveAll($data_saved_local, array('deep' => true));
//                            $this->Session->setFlash(__("Sync Berhasil."), 'default', array(), 'success');
//                            $this->redirect(array('action' => 'admin_sync_data_member'));
//                        } catch (Exception $ex) {
//                            $err_message = "Error : failed to save the records";
//                            echo $err_message;
//                            debug($err_message);
//                        }
//                    }
//                    $this->redirect(array('action' => 'admin_sync_data_member'));
//                } catch (Exception $ex) {
//                    $this->Session->setFlash(__("Sync Failed : Cannot connect to {$ip_address_gate} --> {$ex->getMessage()}"), 'default', array(), 'danger');
//                    $this->redirect(array('action' => 'admin_sync_data_member'));
//                }
//            } else {
//                $dataDiffLocal = [];
//                $dataDiffRPI = [];
//
//                // Data Raspberry Pi
//                $dataRPI = [];
//                $dataCompareRPI = [];
//                $ip_address_gate = ClassRegistry::init("Gate")->get_ip_address($gate_id);
//                $is_connect_to_RPI = FALSE;
//                try {
//                    if ($conn = @new mysqli($ip_address_gate, $this->username, $this->password, $this->db_name)) {
//                        if ($conn->connect_error) {
//                            $this->Session->setFlash(__("Cannot connect to {$ip_address_gate} : {$conn->connect_error}"), 'default', array(), 'danger');
//                            $this->redirect(array('action' => 'admin_sync_data_member'));
//                        }
//                        $sql = "SELECT id, name, uid, expired_dt from members";
//                        $result = $conn->query($sql);
//                        if ($result->num_rows > 0) {
//                            while ($row = $result->fetch_assoc()) {
//                                $dataCompareRPI[] = [
//                                    "name" => $row['name'],
//                                    "uid" => $row['uid'],
//                                    "expired_dt" => $row['expired_dt']
//                                ];
//                                $dataRPI[$row['id']] = [
//                                    "data" => $row['id'] . " -- " . @$row['name'] . " -- " . $row['uid'] . " -- " . $helper->cvtWaktuDetik($row['expired_dt']),
//                                    "is_diff" => FALSE
//                                ];
//                            }
//                        }
//                        $conn->close();
//                        $is_connect_to_RPI = TRUE;
//                    } else {
//                        $this->Session->setFlash(__("Cannot connect to {$ip_address_gate} : {$conn->connect_error}"), 'default', array(), 'danger');
//                        $this->redirect(array('action' => 'admin_sync_data_member'));
//                    }
//                } catch (Exception $ex) {
//                    $this->Session->setFlash(__("Cannot connect to {$ip_address_gate} : {$ex->getMessage()}"), 'default', array(), 'danger');
//                    $this->redirect(array('action' => 'admin_sync_data_member'));
//                }
//
//                if ($is_connect_to_RPI) {
//                    // Data Local
//                    $dataLocal = [];
//                    $dataCompareLocal = [];
//                    $dataMemberLocal = $this->{Inflector::classify($this->name)}->find("all", [
//                        "fields" => [
//                            "Member.id",
//                            "Member.uid",
//                            "Member.name",
//                            "Member.expired_dt"
//                        ],
//                        "recursive" => -1
//                    ]);
//                    if (!empty($dataMemberLocal)) {
//                        foreach ($dataMemberLocal as $memberLocal) {
//                            $dataCompareLocal[] = [
//                                "name" => $memberLocal['Member']['name'],
//                                "uid" => $memberLocal['Member']['uid'],
//                                "expired_dt" => $memberLocal['Member']['expired_dt']
//                            ];
//                            $dataLocal[$memberLocal['Member']['id']] = [
//                                "data" => $memberLocal['Member']['id'] . " -- " . $memberLocal['Member']['name'] . " -- " . $memberLocal['Member']['uid'] . " -- " . $helper->cvtWaktuDetik($memberLocal['Member']['expired_dt']),
//                                "is_diff" => FALSE
//                            ];
//                        }
//                    }
//
//                    // compare process
//                    $diff = array_column($this->_calculateDifference($dataCompareLocal, $dataCompareRPI), "uid");
//
//                    // re-flag the data
//                    foreach ($dataLocal as $member_id => $data) {
//                        $temp = explode(" -- ", $data['data']);
//                        $data_uid = $temp[2];
//                        if (in_array($data_uid, $diff)) {
//                            $dataLocal[$member_id]['is_diff'] = TRUE;
//                        }
//                    }
//                    foreach ($dataRPI as $member_id => $data) {
//                        $temp = explode(" -- ", $data['data']);
//                        $data_uid = $temp[2];
//                        if (in_array($data_uid, $diff)) {
//                            $dataRPI[$member_id]['is_diff'] = TRUE;
//                        }
//                    }
//                }
//                $this->set("dataRaspi", ClassRegistry::init("Gate")->get_gate_name($gate_id));
//                $this->set(compact('dataLocal', 'dataRPI'));
//            }
//        } else {
//            $this->Session->setFlash(__("Invalid Gate ID"), 'default', array(), 'warning');
//            $this->redirect(array('action' => 'admin_sync_data_member'));
//        }
//    }
//
//    function _calculateDifference($dataLocal, $dataRPI)
//    {
//        $difference = [];
//        $has_diff = FALSE;
//        if (!empty($dataLocal) && !empty($dataRPI)) {
//            foreach ($dataLocal as $local) {
//                foreach ($dataRPI as $rpi) {
//                    if (!empty(array_diff($local, $rpi))) {
//                        $has_diff = TRUE;
//                    } else {
//                        $has_diff = FALSE;
//                        break;
//                    }
//                }
//                if ($has_diff) {
//                    if (!in_array($local, $difference)) {
//                        $difference[] = $local;
//                    }
//                }
//                $has_diff = FALSE;
//            }
//            foreach ($dataRPI as $rpi) {
//                foreach ($dataLocal as $local) {
//                    if (!empty(array_diff($rpi, $local))) {
//                        $has_diff = TRUE;
//                    } else {
//                        $has_diff = FALSE;
//                        break;
//                    }
//                }
//                if ($has_diff) {
//                    if (!in_array($rpi, $difference)) {
//                        $difference[] = $rpi;
//                    }
//                }
//                $has_diff = FALSE;
//            }
//        } else {
//            if (empty($dataLocal) && !empty($dataRPI)) {
//                $difference = $dataRPI;
//            } else if (!empty($dataLocal) && empty($dataRPI)) {
//                $difference = $dataLocal;
//            }
//        }
//        return $difference;
//    }

}
