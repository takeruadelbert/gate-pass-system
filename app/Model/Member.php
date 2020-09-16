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

    function beforeSave($options = array())
    {
        $dataConfiguration = ClassRegistry::init('EntityConfiguration')->find("first");
        if(!empty($dataConfiguration)) {
            if($dataConfiguration['EntityConfiguration']['enable_auto_sync']) {
                if(empty($this->data[$this->alias]['id'])) { // ADD
                    $this->addNewMember($this->data);
                }
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
                $this->saveDataMemberToDataSync($payload, _HTTP_REQUEST_METHOD_POST);
            }
        }
    }

    public function editDataMember($data) {
        if(isset($data['MemberCard']) && !empty($data['MemberCard'])) {
            $this->getDataCardMember($data['Member']['id'], _HTTP_REQUEST_METHOD_DELETE);
        }
    }

    public function getUpdateDataMember($memberId) {
        $this->getDataCardMember($memberId, _HTTP_REQUEST_METHOD_POST);
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
                    $this->saveDataMemberToDataSync($payload, $requestMethod);
                }
            }
        }
    }

    private function saveDataMemberToDataSync($payload, $requestMethod) {
        try {
            $data = [
                "DataSync" => [
                    "request_method" => $requestMethod,
                    "data" => json_encode($payload)
                ]
            ];
            ClassRegistry::init('DataSync')->create();
            ClassRegistry::init("DataSync")->save($data);
        } catch (Exception $ex) {
            debug($ex);
            debug("Error Occurred when saving data sync : ", $ex->getMessage());
            die;
        }
    }
}
