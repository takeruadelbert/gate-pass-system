<?php

class MemberCard extends AppModel
{

    public $validate = array(
        'card_number' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah Ada' => array("rule" => 'isUnique')
        ),
        'expired_dt' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
        ),
    );
    public $belongsTo = array(
        "Member"
    );
    public $hasOne = array();
    public $hasMany = array();
    public $virtualFields = array();
    public static $statusBanned = "BANNED";
    public static $statusActive = "ACTIVE";

    public function sendToDataSync($clientId, $dataMemberCard, $requestMethod, $isFromDataMember = false) {
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
                if(!empty($dataClient['Gate'])) {
                    foreach ($dataClient['Gate'] as $gate) {
                        $payload = [
                            'code' => !$isFromDataMember ? $dataMemberCard['MemberCard']['card_number'] : $dataMemberCard['card_number'],
                            'expiration' => !$isFromDataMember ? $dataMemberCard['MemberCard']['expired_dt'] : $dataMemberCard['expired_dt']
                        ];
                        if($requestMethod === _HTTP_REQUEST_METHOD_POST) {
                            $dataSync = [
                                'DataSync' => [
                                    'request_method' => $requestMethod,
                                    'data' => json_encode($payload),
                                    'url' => sprintf("%s%s%s", _HTTP_PROTOCOL, $gate['ip_address'], _URL_API_MEMBER),
                                    'header' => sprintf("%s: %s/%s", "Sync-Target", $dataClient['Client']['code'], $gate['code'])
                                ]
                            ];
                        } else {
                            $dataSync = [
                                'DataSync' => [
                                    'request_method' => $requestMethod,
                                    'data' => "{}",
                                    'url' => sprintf("%s%s%s/%s", _HTTP_PROTOCOL, $gate['ip_address'], _URL_API_MEMBER, $payload['code']),
                                    'header' => sprintf("%s: %s/%s", "Sync-Target", $dataClient['Client']['code'], $gate['code'])
                                ]
                            ];
                        }
                        ClassRegistry::init('DataSync')->create();
                        ClassRegistry::init('DataSync')->save($dataSync);
                    }
                }
            }
        } catch (Exception $ex) {
            debug('Error occurred whilst saving data sync : ', $ex);
        }
    }
}
