<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'Api');

class MemberCardsController extends AppController
{
    var $name = "MemberCards";
    var $disabledAction = array();

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('MemberCard');
    }

    function admin_list($isWhitelist = false) {
        $this->autoRender = false;
        $conds = !$isWhitelist ? ["MemberCard.status =" => MemberCard::$statusActive] : ["MemberCard.status" => MemberCard::$statusBanned];
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $conds[] = [
                "or" => [
                    "MemberCard.card_number like" => "%$q%",
                ]
            ];
        }
        $suggestions = ClassRegistry::init("MemberCard")->find("all", array(
            "conditions" => [
                $conds,
            ],
            "contain" => [
                "Member",
            ],
            "limit" => 10,
        ));
        $result = [];
        foreach ($suggestions as $item) {
            if (!empty($item['MemberCard'])) {
                $result[] = [
                    "id" => $item['MemberCard']['id'],
                    "card_number" => $item['MemberCard']['card_number'],
                    "name" => $item['Member']['name']
                ];
            }
        }
        return json_encode($result);
    }
}
