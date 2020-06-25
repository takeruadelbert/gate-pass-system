<?php
App::uses('AppController', 'Controller');
App::uses('HtmlHelper', 'View/Helper');
App::import('Controller', 'Api');

class HistoriesController extends AppController
{
    var $name = "Histories";
    var $disabledAction = array(
        "admin_add",
        "admin_edit",
        "admin_delete"
    );
    var $contain = array();
    private $readHistoryUrlApi = "/api/history/";

    function beforeRender()
    {
        $this->_options();
        parent::beforeRender();
    }

    function _options()
    {
        $this->set("gates", ClassRegistry::init("Gate")->find("list", ['fields' => ['Gate.id', 'Gate.full_label'], 'recursive' => -1]));
    }

    function admin_read_data_history()
    {
        if ($this->request->is("POST")) {
            $gate_id = $this->data['History']['gate_id'];
            if (!empty($gate_id)) {
                $dataGate = ClassRegistry::init("Gate")->find("first", [
                    "conditions" => [
                        "Gate.id" => $gate_id
                    ],
                    "fields" => [
                        "Gate.id",
                        "Gate.ip_address",
                        "Client.id",
                        "Client.name"
                    ],
                    "recursive" => -1,
                    "contain" => [
                        "Client"
                    ]
                ]);
                if (!empty($dataGate)) {
                    $ip_address = $dataGate['Gate']['ip_address'];
                    $url = sprintf("%s%s", $ip_address, $this->readHistoryUrlApi);
                    $header = [
                        sprintf("%s: %s/%s", "Sync-Target", $dataGate['Client']['name'], $dataGate['Gate']['name'])
                    ];
                    $response = ApiController::apiGet($url, $header);
                    if ($response['http_response_code'] == 200) {
                        $helper = new HtmlHelper(new View());

                        $result = json_decode($response['body_response'], true);
                        if (!empty($result)) {
                            $response = ApiController::apiDelete($url);
                            if ($response['http_response_code'] == 200) {
                                $saveData = [];
                                $dataHistory = json_decode($result, true);
                                foreach ($dataHistory as $history) {
                                    $saveData[] = [
                                        "History" => [
                                            "code" => $history['code'],
                                            "datetime" => $helper->convertDateFormatToDefault($history['time']),
                                            "path_face" => $history['path_face'],
                                            "path_plate" => $history['path_plate'],
                                            "gate_id" => $gate_id
                                        ]
                                    ];
                                }
                                $this->{Inflector::classify($this->name)}->saveAll($saveData, ['deep' => true]);
                                $this->Session->setFlash(__("Read Data History {$ip_address} Success."), 'default', array(), 'success');
                            } else {
                                $this->Session->setFlash(__($response['body_response']), 'default', array(), 'warning');
                            }
                        } else {
                            $this->Session->setFlash(__("No Data History found."), 'default', array(), 'info');
                        }
                    } else {
                        $this->Session->setFlash(__($response['body_response']), 'default', array(), 'warning');
                    }
                } else {
                    $this->Session->setFlash(__("Gate Not Found."), 'default', array(), 'danger');
                }
            } else {
                $this->Session->setFlash(__("Invalid Gate ID."), 'default', array(), 'danger');
            }
            $this->redirect(Router::url('/read-history-device', true));
        }
    }
}