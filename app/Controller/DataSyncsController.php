<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Api');

class DataSyncsController extends AppController
{
    var $name = "DataSyncs";
    var $disabledAction = array(
        "admin_add",
        "admin_edit",
        "admin_delete"
    );
    private $MAX_LIMIT_SYNC = 20;

    function api_sync() {
        $this->autoRender = false;
        $dataSync = ClassRegistry::init("DataSync")->find("all",[
            "conditions" => [
                "DataSync.has_synced" => false
            ],
            "limit" => $this->MAX_LIMIT_SYNC,
            "recursive" => -1,
        ]);
        if(!empty($dataSync)) {
            foreach ($dataSync as $data) {
                $this->sendDataApi($data['DataSync']['request_method'], $data['DataSync']['url'], $data['DataSync']['data'], [$data['DataSync']['header']], $data);
            }
        } else {
            debug('No Data Sync.');
        }
    }

    private function sendDataApi($requestMethod, $url, $payload, $header, $syncData) {
        $decodedPayload = json_decode($payload, true);
        switch ($requestMethod) {
            case _HTTP_REQUEST_METHOD_POST:
                $response = ApiController::apiPost($url, $decodedPayload, $header);
                debug($response);
                if($response['http_response_code'] === 201 || $response['http_response_code'] === 409) {
                    $this->updateSyncedData($syncData);
                } else {
                    debug($response['body_response']);
                }
                break;
            case _HTTP_REQUEST_METHOD_DELETE:
                $response = ApiController::apiDelete($url, $payload, $header);
                if($response['http_response_code'] === 200) {
                    $this->updateSyncedData($syncData);
                } else {
                    debug($response['body_response']);
                }
                break;
            default:
                debug("Invalid HTTP Request Method : {$requestMethod}");
                break;
        }
    }

    private function updateSyncedData($syncData) {
        try {
            $syncData['DataSync']['has_synced'] = true;
            ClassRegistry::init('DataSync')->create();
            ClassRegistry::init('DataSync')->save($syncData);
            debug("data has been updated.");
        } catch (Exception $ex) {
            debug('Error occurred when updating sync data', $ex);
        }
    }

    public function admin_index()
    {
        $conds = [];
        if (isset($this->request->query['start_date']) && !empty($this->request->query['start_date'])) {
            $start_date = $this->request->query['start_date'];
            $conds[] = [
                "DATE_FORMAT(DataSync.created, '%Y-%m-%d %H:%i:%s') >=" => $start_date
            ];
            unset($_GET['start_date']);
            $this->set(compact('start_date'));
        }
        if (isset($this->request->query['end_date']) && !empty($this->request->query['end_date'])) {
            $end_date = $this->request->query['end_date'];
            $conds[] = [
                "DATE_FORMAT(DataSync.created, '%Y-%m-%d %H:%i:%s') <=" => $end_date
            ];
            unset($_GET['end_date']);
            $this->set(compact('end_date'));
        }
        $this->order = "DataSync.created DESC";
        $this->conds = $conds;
        parent::admin_index();
    }
}