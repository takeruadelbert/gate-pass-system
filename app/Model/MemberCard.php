<?php

class MemberCard extends AppModel
{

    public $validate = array(
        'card_number' => array(
            'rule' => 'NotBlank',
            'message' => 'Harus Diisi.'
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

    public function sendToDataSync($dataMemberCard, $requestMethod, $isFromDataMember = false) {
        $payload = [
            'code' => !$isFromDataMember ? $dataMemberCard['MemberCard']['card_number'] : $dataMemberCard['card_number'],
            'expiration' => !$isFromDataMember ? $dataMemberCard['MemberCard']['expired_dt'] : $dataMemberCard['expired_dt']
        ];
        $dataSync = [
            'DataSync' => [
                'request_method' => $requestMethod,
                'data' => json_encode($payload)
            ]
        ];
        try {
            ClassRegistry::init('DataSync')->create();
            ClassRegistry::init('DataSync')->save($dataSync);
        } catch (Exception $ex) {
            debug('Error occurred whilst saving data sync : ', $ex);
        }
    }
}
