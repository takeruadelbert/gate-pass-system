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
                        "Gate.code",
                        "Client.id",
                        "Client.name",
                        "Client.code"
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
                        sprintf("%s: %s/%s", "Sync-Target", $dataGate['Client']['code'], $dataGate['Gate']['code'])
                    ];
                    $response = ApiController::apiGet($url, $header);
                    if ($response['http_response_code'] == 200) {
                        $helper = new HtmlHelper(new View());

                        $result = json_decode($response['body_response'], true);
                        if (!empty($result)) {
                            $response = ApiController::apiDelete($url, "{}",$header);
                            if ($response['http_response_code'] == 200) {
                                $saveData = [];
                                $dataHistory = $result;
                                foreach ($dataHistory as $history) {
                                    $saveData[] = [
                                        "History" => [
                                            "code" => $history['code'],
                                            "datetime" => $helper->convertDateFormatToDefault($history['time']),
                                            "image_face" => !empty($history['path_face']) ? file_get_contents($history['path_face']) : null,
                                            "image_plate" => !empty($history['path_plate']) ? file_get_contents($history['path_plate']) : null,
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

    function admin_index()
    {
        $this->order = "History.datetime DESC";
        $conds = [];
        if (isset($this->request->query['start_date']) && !empty($this->request->query['start_date'])) {
            $start_date = $this->request->query['start_date'];
            $conds[] = [
                "DATE_FORMAT(History.datetime, '%Y-%m-%d %H:%i:%s') >=" => $start_date
            ];
            unset($_GET['start_date']);
        }
        if (isset($this->request->query['end_date']) && !empty($this->request->query['end_date'])) {
            $end_date = $this->request->query['end_date'];
            $conds[] = [
                "DATE_FORMAT(History.datetime, '%Y-%m-%d %H:%i:%s') <=" => $end_date
            ];
            unset($_GET['end_date']);
        }
        $this->conds = $conds;
        parent::admin_index();
    }
}