<?php

App::uses('AppController', 'Controller');

class EntityConfigurationsController extends AppController {

    var $name = "EntityConfigurations";
    var $disabledAction = array(
        "admin_index",
        "admin_add",
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_edit($xid = 1) {
        $id = 1;
        if ($this->request->is("post") || $this->request->is("put")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            $this->{Inflector::classify($this->name)}->data['EntityConfiguration']['enable_auto_sync'] = isset($this->data['EntityConfiguration']['enable_auto_sync']);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                if (!is_null($id)) {
                    $this->{ Inflector::classify($this->name) }->data[Inflector::classify($this->name)]['id'] = $id;
                    if(!empty($this->data['EntityConfiguration']['filelogo1']['name'])) {
                        App::import("Vendor", "qqUploader");
                        $allowedExt = array("jpg", "jpeg", "png", "gif");
                        $size = 10 * 1024 * 1024;
                        $uploader = new qqFileUploader($allowedExt, $size, $this->data['EntityConfiguration']['filelogo1']);
                        $result = $uploader->handleUpload("img" . DS . "kop" . DS);
                        switch ($result['status']) {
                            case 206:
                                $this->{ Inflector::classify($this->name) }->data['EntityConfiguration']['logo1'] = "/{$result['data']['folder']}{$result['data']['fileName']}";
                                break;
                            case 441:
                                break;
                            default:
                                $this->Session->setFlash(__($result['message']), 'default', array(), 'danger');
                                $this->redirect(array('action' => 'admin_edit'));
                                break;
                        }
                    }
                    $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                    $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                    $this->redirect(array('action' => 'admin_edit'));
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array(
                'conditions' => array(
                    Inflector::classify($this->name) . ".id" => $id
                ),
                'recursive' => 2
            ));
            $this->data = $rows;
        }
    }

    function admin_change_logo($id = 1) {
        $id = 1;
        if ($this->request->is("post") || $this->request->is("put")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                if (!is_null($id)) {                    
                    if (!empty($this->{Inflector::classify($this->name)}->data['EntityConfiguration']['logo']['size'])) {
                        App::import("Vendor", "qqUploader");
                        $allowedExt = array("jpg", "jpeg", "png");
                        $size = 10 * 1024 * 1024;
                        $uploader = new qqFileUploader($allowedExt, $size, $this->{Inflector::classify($this->name)}->data['EntityConfiguration']['logo']);
                        $result = $uploader->handleUpload("img" . DS . "logo" . DS);
                        switch ($result['status']) {
                            case 206:
                                $this->{Inflector::classify($this->name)}->data['EntityConfiguration']['logo'] = "/{$result['data']['folder']}{$result['data']['fileName']}";
                                $this->{ Inflector::classify($this->name) }->data[Inflector::classify($this->name)]['id'] = $id;
                                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                                $this->Session->setFlash(__("Logo Berhasil Diubah."), 'default', array(), 'success');
                                $this->redirect(array('action' => 'admin_change_logo'));
                                break;
                            case 442:
                                break;
                            case 443:
                                $this->Session->setFlash(__($result['message']), 'default', array(), 'danger');
                                return;
                                break;
                        }
                    } else {
                        $this->Session->setFlash(__("Logo Wajib Diupload."), 'default', array(), 'danger');
                    }
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->redirect(array('action' => 'admin_change_logo'));
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array(
                'conditions' => array(
                    Inflector::classify($this->name) . ".id" => $id
                ),
                'recursive' => 2
            ));
            $this->data = $rows;
        }
    }

    function admin_change_background_login($id = 1) {
        $id = 1;
        if ($this->request->is("post") || $this->request->is("put")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                if (!is_null($id)) {                    
                    if (!empty($this->{Inflector::classify($this->name)}->data['EntityConfiguration']['background']['size'])) {
                        App::import("Vendor", "qqUploader");
                        $allowedExt = array("jpg", "jpeg", "png");
                        $size = 10 * 1024 * 1024;
                        $uploader = new qqFileUploader($allowedExt, $size, $this->{Inflector::classify($this->name)}->data['EntityConfiguration']['background']);
                        $result = $uploader->handleUpload("img" . DS . "background-login" . DS);
                        switch ($result['status']) {
                            case 206:
                                $this->{Inflector::classify($this->name)}->data['EntityConfiguration']['background_cover'] = "/{$result['data']['folder']}{$result['data']['fileName']}";
                                $this->{ Inflector::classify($this->name) }->data[Inflector::classify($this->name)]['id'] = $id;
                                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                                $this->Session->setFlash(__("Background Login Berhasil Diubah."), 'default', array(), 'success');
                                $this->redirect(array('action' => 'admin_change_background_login'));
                                break;
                            case 442:
                                break;
                            case 443:
                                $this->Session->setFlash(__($result['message']), 'default', array(), 'danger');
                                return;
                                break;
                        }
                    } else {
                        $this->Session->setFlash(__("Background Wajib Diupload."), 'default', array(), 'danger');
                    }
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->redirect(array('action' => 'admin_change_logo'));
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array(
                'conditions' => array(
                    Inflector::classify($this->name) . ".id" => $id
                ),
                'recursive' => 2
            ));
            $this->data = $rows;
        }
    }
}
