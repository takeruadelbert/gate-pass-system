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
        $this->loadModel('MemberCard');
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

    function admin_edit($id = null) {
        if (!$this->{ Inflector::classify($this->name) }->exists($id)) {
            throw new NotFoundException(__('Data tidak ditemukan'));
        } else {
            if ($this->request->is("post") || $this->request->is("put")) {
                if(isset($this->data['MemberCard']) && !empty($this->data['MemberCard'])) {
                    $this->{ Inflector::classify($this->name) }->set($this->data);
                    $this->{ Inflector::classify($this->name) }->data[Inflector::classify($this->name)]['id'] = $id;
                    if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                        if (!is_null($id)) {
                            ClassRegistry::init('Member')->editDataMember($this->{ Inflector::classify($this->name) }->data);
                            $this->{ Inflector::classify($this->name) }->_deleteableHasmany();
                            $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                            ClassRegistry::init('Member')->getUpdateDataMember($id);
                            $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                            $this->redirect(array('action' => 'admin_index'));
                        }
                    } else {
                        $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                    }
                } else {
                    $this->Session->setFlash(__("Nomor Kartu Harus Diisi."), 'default', array(), 'info');
                }
            } else {
                $rows = $this->{ Inflector::classify($this->name) }->find("first", array(
                    'conditions' => array(
                        Inflector::classify($this->name) . ".id" => $id
                    ),
                    'recursive' => 2
                ));
                $this->data = $rows;
            }
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
                    'Gate.code',
                    "Client.id",
                    "Client.name",
                    "Client.code"
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
                                "MemberCard.expired_dt",
                                "MemberCard.status"
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
            $bannedMembers = [];
            if (!empty($dataClient)) {
                foreach ($dataClient as $client) {
                    if (!empty($client['Member'])) {
                        foreach ($client['Member'] as $member) {
                            foreach ($member['MemberCard'] as $detail) {
                                if($detail['status'] === MemberCard::$statusBanned) {
                                   $bannedMembers[] = $detail['id'];
                                } else {
                                    $param[] = [
                                        "code" => $detail['card_number'],
                                        "expiration" => $detail['expired_dt']
                                    ];
                                }
                            }
                        }
                    }
                }
                $this->sync_member($url, $param, $dataGate['Client']['code'], $dataGate['Gate']['code'], $bannedMembers, $ipAddress);
            }

        } else {
            $this->Session->setFlash(__("Invalid Gate ID"), 'default', array(), 'warning');
        }
        $this->redirect(Router::url('/sync-data-member', true));
    }

    function sync_member($url, $param, $clientCode, $gateCode, $bannedMembers, $ipAddress) {
        $header = [
            sprintf("%s: %s/%s", "Sync-Target", $clientCode, $gateCode)
        ];
        $response = ApiController::apiPut($url, $param, $header);
        if ($response['http_response_code'] == 200) {
            $this->sync_banned_member($url, $header, $bannedMembers, $ipAddress);
        } else {
            $this->Session->setFlash(__($response['body_response']), 'default', array(), 'warning');
        }
    }

    function sync_banned_member($url, $header, $bannedMembers, $ipAddress) {
        if(!empty($bannedMembers)) {
            $response = ApiController::apiDelete($url, $bannedMembers, $header);
            if ($response['http_response_code'] == 200) {
                $this->Session->setFlash(__("Sync to {$ipAddress} Success."), 'default', array(), 'success');
            } else {
                $this->Session->setFlash(__($response['body_response']), 'default', array(), 'warning');
            }
        } else {
            $this->Session->setFlash(__("Sync to {$ipAddress} Success."), 'default', array(), 'success');
        }
    }

    function admin_blacklist_card_member() {
        $this->update_status_card_member(MemberCard::$statusBanned);
    }

    function admin_list() {
        $this->autoRender = false;
        $conds = [];
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $conds[] = [
                "or" => [
                    "Member.name like" => "%$q%",
                ]
            ];
        }
        $suggestions = ClassRegistry::init("Member")->find("all", array(
            "conditions" => [
                $conds,
            ],
            "recursive" => -1,
            "limit" => 10,
        ));
        $result = [];
        foreach ($suggestions as $item) {
            if (!empty($item['Member'])) {
                $result[] = [
                    "id" => $item['Member']['id'],
                    "name" => $item['Member']['name']
                ];
            }
        }
        return json_encode($result);
    }

    function admin_blacklist_member() {
        $this->update_status_all_card_members(MemberCard::$statusBanned);
    }

    function admin_whitelist_card_member() {
        $this->update_status_card_member(MemberCard::$statusActive);
    }

    function admin_whitelist_member() {
        $this->update_status_all_card_members(MemberCard::$statusActive);
    }

    private function update_status_card_member($status) {
        if($this->request->is("POST")) {
            $memberCardId = $this->data['MemberCard']['id'];
            if(empty($memberCardId)) {
                $this->Session->setFlash(__("Invalid Member ID"), 'default', array(), 'info');
                return;
            }
            $memberCard = ClassRegistry::init("MemberCard")->find('first', [
                "conditions" => [
                    "MemberCard.id" => $memberCardId
                ],
                "contain" => [
                    'Member'
                ]
            ]);
            if(!empty($memberCard)) {
                $memberCard['MemberCard']['status'] = $status;
                try {
                    $requestMethod = $status === MemberCard::$statusActive ? _HTTP_REQUEST_METHOD_POST : _HTTP_REQUEST_METHOD_DELETE;
                    ClassRegistry::init('MemberCard')->sendToDataSync($memberCard['Member']['client_id'], $memberCard, $requestMethod);
                    ClassRegistry::init("MemberCard")->save($memberCard);
                    $message = $status === MemberCard::$statusBanned ? "Diblacklist" : "Diwhitelist";
                    $this->Session->setFlash(__(sprintf("Berhasil %s.", $message)), 'default', array(), 'success');
                } catch (Exception $ex) {
                    $this->Session->setFlash(__($ex->getMessage()), 'default', array(), 'warning');
                }
            } else {
                $this->Session->setFlash(__("Data Member Not Found."), 'default', array(), 'info');
            }
        }
    }

    private function update_status_all_card_members($status) {
        if($this->request->is("POST")) {
            $memberId = $this->data['Member']['id'];
            if(empty($memberId)) {
                $this->Session->setFlash(__("Invalid Member ID"), 'default', array(), 'info');
                return;
            }
            $member = ClassRegistry::init("Member")->find('first', [
                "conditions" => [
                    "Member.id" => $memberId
                ],
                "contain" => [
                    "MemberCard"
                ]
            ]);
            if(!empty($member['MemberCard'])) {
                $bannedCardMember = [];
                $requestMethod = $status === MemberCard::$statusActive ? _HTTP_REQUEST_METHOD_POST : _HTTP_REQUEST_METHOD_DELETE;
                foreach ($member['MemberCard'] as $memberCard) {
                    if($memberCard['status'] !== $status) {
                        $bannedCardMember[] = [
                            "id" => $memberCard['id'],
                            "status" => $status
                        ];
                    }
                    ClassRegistry::init("MemberCard")->sendToDataSync($member['Member']['client_id'], $memberCard, $requestMethod, true);
                }
                if(!empty($bannedCardMember)) {
                    try {
                        ClassRegistry::init("MemberCard")->saveAll($bannedCardMember);
                        $message = $status === MemberCard::$statusBanned ? "Diblacklist." : "Diwhitelist";
                        $this->Session->setFlash(__(sprintf("Berhasil %s.", $message)), 'default', array(), 'success');
                    } catch (Exception $ex) {
                        $this->Session->setFlash(__($ex->getMessage()), 'default', array(), 'warning');
                    }
                } else {
                    $this->Session->setFlash(__("Kartu Member Sudah Diban Semua."), 'default', array(), 'info');
                }
            } else {
                $this->Session->setFlash(__("Data Kartu Member Tidak Ada."), 'default', array(), 'info');
            }
        }
    }
}
