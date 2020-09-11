<?php


class ClientsController extends AppController
{
    var $name = "Clients";
    var $disabledAction = array();

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options()
    {
        $this->set("gates", ClassRegistry::init("Gate")->get_list_gate_by_type());
    }

    function beforeRender()
    {
        $this->_options();
        parent::beforeRender();
    }

    function admin_add()
    {
        if ($this->request->is("post")) {
            $gate_ids = isset($this->data['Dummy']) ? array_column($this->data['Dummy'], 'gate_id') : null;
            $this->{Inflector::classify($this->name)}->set($this->data);
            if ($this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('validate' => 'only', "deep" => true))) {
                $this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('deep' => true));

                $clientLastInsertId = $this->{Inflector::classify($this->name)}->getLastInsertID();
                if (!empty($gate_ids)) {
                    ClassRegistry::init("Gate")->updateAll(['Gate.client_id' => $clientLastInsertId], ['Gate.id' => $gate_ids]);
                }

                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{Inflector::classify($this->name)}->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
    }

    function admin_edit($id = null)
    {
        if (!$this->{Inflector::classify($this->name)}->exists($id)) {
            throw new NotFoundException(__('Data tidak ditemukan'));
        } else {
            if ($this->request->is("post") || $this->request->is("put")) {
                $dataSelectedGateIds = array_column($this->data['Dummy'], 'gate_id');
                $this->{Inflector::classify($this->name)}->set($this->data);
                $this->{Inflector::classify($this->name)}->data[Inflector::classify($this->name)]['id'] = $id;
                if ($this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('validate' => 'only', "deep" => true))) {
                    if (!is_null($id)) {
                        debug($this->data);

                        // update data gate
                        $dataExistGateIds = ClassRegistry::init("Gate")->find('list', [
                            'conditions' => [
                                'Gate.client_id' => $id
                            ],
                            'fields' => [
                                'Gate.id',
                                'Gate.id'
                            ],
                            'recursive' => -1
                        ]);
                        $diff = array_merge(array_diff($dataSelectedGateIds, $dataExistGateIds), array_diff($dataExistGateIds, $dataSelectedGateIds));
                        if (!empty($diff)) {
                            foreach ($diff as $gate_id) {
                                if (in_array($gate_id, $dataExistGateIds)) {
                                    ClassRegistry::init("Gate")->updateAll(['Gate.client_id' => null], ['Gate.id' => $gate_id]);
                                } else {
                                    ClassRegistry::init("Gate")->updateAll(['Gate.client_id' => $id], ['Gate.id' => $gate_id]);
                                }
                            }
                        }

                        $this->{Inflector::classify($this->name)}->saveAll($this->{Inflector::classify($this->name)}->data, array('deep' => true));
                        $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                        $this->redirect(array('action' => 'admin_index'));
                    }
                } else {
                    $this->request->data[Inflector::classify($this->name)]["id"] = $id;
                    $this->validationErrors = $this->{Inflector::classify($this->name)}->validationErrors;
                }
            } else {
                $rows = $this->{Inflector::classify($this->name)}->find("first", array(
                    'conditions' => array(
                        Inflector::classify($this->name) . ".id" => $id
                    ),
                    'recursive' => 2
                ));
                $this->data = $rows;
            }
        }
    }
}