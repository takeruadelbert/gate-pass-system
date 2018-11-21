<?php

App::uses('AppController', 'Controller');

class MembersController extends AppController {

    var $name = "Members";
    var $disabledAction = array(
    );
    var $contain = array(
        "MemberDetail" => [
            "Gate"
        ]
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
    
    function _options() {
        $this->set("gates", ClassRegistry::init("Gate")->get_list_gate());
        $this->set("gateWithTypes", ClassRegistry::init("Gate")->get_list_gate_by_type());
    }
    
    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
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
                $this->{ Inflector::classify($this->name) }->set($this->data);
                $this->{ Inflector::classify($this->name) }->data[Inflector::classify($this->name)]['id'] = $id;
                if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                    if (!is_null($id)) {                        
                        // remove unpicked access gate(s)
                        if(!empty($this->{Inflector::classify($this->name)}->data['MemberDetail'])) {
                            foreach ($this->{Inflector::classify($this->name)}->data['MemberDetail'] as $i => $detail) {
                                if(empty($detail['gate_id'])) {
                                   unset($this->{Inflector::classify($this->name)}->data['MemberDetail'][$i]); 
                                }
                            }
                        }
                        $this->{Inflector::classify($this->name)}->_deleteableHasmany();                        
                        $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                        $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                        $this->redirect(array('action' => 'admin_index'));
                    }
                } else {
                    $this->request->data[Inflector::classify($this->name)]["id"] = $id;
                    $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                }
            } else {
                $rows = $this->{ Inflector::classify($this->name) }->find("first", array(
                    'conditions' => array(
                        Inflector::classify($this->name) . ".id" => $id
                    ),
                    'contain' => [
                        "MemberDetail" => [
                            "Gate"
                        ]
                    ]
                ));
                $this->data = $rows;
                $this->set("gate_ids", ClassRegistry::init("Gate")->get_all_ids());
            }
        }
    }

    function admin_multi_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                unset($this->{Inflector::classify($this->name)}->data['Member']['input-addon-checkbox']);                
                if(!empty($this->{Inflector::classify($this->name)}->data['Member'])) {
                    foreach ($this->{Inflector::classify($this->name)}->data['Member'] as $i => $member) {
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['uid'] = $member['Member']['uid'];
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['name'] = $member['Member']['name'];
                        $this->{Inflector::classify($this->name)}->data[$i]['Member']['expired_dt'] = $member['Member']['expired_dt'];
                        $this->{Inflector::classify($this->name)}->data[$i]['MemberDetail'] = $this->{Inflector::classify($this->name)}->data['MemberDetail'];
                    }
                }
                unset($this->{Inflector::classify($this->name)}->data['Member']);
                unset($this->{Inflector::classify($this->name)}->data['MemberDetail']);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        } else {
            $this->set("gate_ids", ClassRegistry::init("Gate")->get_all_ids());
        }
    }

    function admin_index() {
        $this->conds = "";
        if(isset($this->request->query['gates']) && !empty($this->request->query['gates'])) {
            $dataMemberDetail = ClassRegistry::init("MemberDetail")->find("list",[
                    "conditions" => [
                        "OR" => [
                            "MemberDetail.gate_id" => $this->request->query['gates']
                        ]
                    ],
                    "recursive" => -1,
                    "group" => "MemberDetail.member_id",
                    "fields" => [
                        "MemberDetail.id",
                        "MemberDetail.member_id"
                    ]
                ]);
            $member_ids = !empty($dataMemberDetail) ? array_values($dataMemberDetail) : [];
            $this->conds = [
                "Member.id" => $member_ids
            ];
            $this->set("chosen_gate", $this->request->query['gates']);
            unset($_GET['gates']);
        }
        parent::admin_index();
    }
}
