<?php

App::uses('AppController', 'Controller');

class LoginPagesController extends AppController {

    var $name = "LoginPages";
    var $disabledAction = array(
        "admin_add",
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_index() {
        $this->contain = [
            "LoginPageCredential"=>[
                "UserGroup",
            ]
        ];
        parent::admin_index();
    }

    function admin_edit($id = null) {
        if ($this->request->is("post") || $this->request->is("put")) {
            if (!is_null($id)) {
                foreach ($this->data['LoginPageCredential'] as $item) {
                    if (!isset($item['id'])) {
                        $this->LoginPage->LoginPageCredential->create();
                        $this->LoginPage->LoginPageCredential->save(am(array("login_page_id" => $id), $item));
                    } else {
                        $this->LoginPage->LoginPageCredential->id = $item['id'];
                        $this->LoginPage->LoginPageCredential->save(am(array("login_page_id" => $id), $item));
                    }
                }
                $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                
            }
        } else {
            $row = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array("LoginPage.id" => $id),"contain"=>[
                "LoginPageCredential"=>[
                    "UserGroup",
                ]
            ]));
            $dataUserGroup = $this->LoginPage->LoginPageCredential->UserGroup->find('all', [
                'order' => [
                    'UserGroup.name' => 'ASC'
                ],
                "recursive" => -1,
                "contain" => [
                ]
            ]);
            $this->data = $row;
            $this->set("dataUserGroup", $dataUserGroup);
        }
    }

}
