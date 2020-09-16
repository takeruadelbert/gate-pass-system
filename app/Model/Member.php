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
    public $hasOne = array();
    public $hasMany = array(
        "MemberCard" => [
            "dependent" => TRUE
        ]
    );
    public $virtualFields = array();

    function beforeSave($options = array()) {
        if($this->autoSyncIsEnabled()) {
            if(empty($this->data[$this->alias]['id'])) { // ADD
                $this->addNewMember($this->data);
            }
        }
    }

    private function addNewMember($data) {
        if(isset($data['MemberCard']) && !empty($data['MemberCard'])) {
            foreach ($data['MemberCard'] as $memberCard) {
                $payload = [
                    'code' => $memberCard['card_number'],
                    'expiration' => $memberCard['expired_dt']
                ];
                $this->saveDataMemberToDataSync($data['Member']['client_id'], $payload, _HTTP_REQUEST_METHOD_POST);
            }
        }
    }

    private function autoSyncIsEnabled() {
        $dataConfiguration = ClassRegistry::init('EntityConfiguration')->find("first");
        if(!empty($dataConfiguration)) {
            return (boolean)$dataConfiguration['EntityConfiguration']['enable_auto_sync'];
        } else {
            return false;
        }
    }

    public function editDataMember($data) {
        if($this->autoSyncIsEnabled()) {
            if(isset($data['MemberCard']) && !empty($data['MemberCard'])) {
                $this->getDataCardMember($data['Member']['id'], _HTTP_REQUEST_METHOD_DELETE);
            }
        }
    }

    public function getUpdateDataMember($clientId, $memberId) {
        if($this->autoSyncIsEnabled()) {
            $this->getDataCardMember($memberId, _HTTP_REQUEST_METHOD_POST);
        }
    }

    private function getDataCardMember($memberId, $requestMethod) {
        $dataMember = ClassRegistry::init('Member')->find('first',[
            'conditions' => [
                'Member.id' => $memberId
            ],
            'contain' => [
                'MemberCard'
            ]
        ]);
        if(!empty($dataMember)) {
            if(!empty($dataMember['MemberCard'])) {
                foreach ($dataMember['MemberCard'] as $memberCard) {
                    $payload = [
                        'code' => $memberCard['card_number'],
                        'expiration' => $memberCard['expired_dt']
                    ];
                    $this->saveDataMemberToDataSync($dataMember['Member']['client_id'], $payload, $requestMethod);
                }
            }
        }
    }

    private function saveDataMemberToDataSync($clientId, $payload, $requestMethod) {
        try {
            $dataClient = ClassRegistry::init('Client')->find('first',[
                'conditions' => [
                    'Client.id' => $clientId
                ],
                'contain' => [
                    'Gate'
                ]
            ]);
            if(!empty($dataClient)) {
                foreach ($dataClient['Gate'] as $gate) {
                    $data = [
                        "DataSync" => [
                            "request_method" => $requestMethod,
                            "data" => json_encode($payload),
                            "url" => sprintf("%s%s%s", _HTTP_PROTOCOL, $gate['ip_address'], _URL_API_MEMBER)
                        ]
                    ];
                    ClassRegistry::init('DataSync')->create();
                    ClassRegistry::init("DataSync")->save($data);
                }
            }
        } catch (Exception $ex) {
            debug($ex);
            debug("Error Occurred when saving data sync : ", $ex->getMessage());
            die;
        }
    }

    function beforeDelete($cascade = true)
    {
        foreach ($this->data['Member']['checkbox'] as $deletedId) {
            $this->getDataCardMember($deletedId, _HTTP_REQUEST_METHOD_DELETE);
        }
    }
}
