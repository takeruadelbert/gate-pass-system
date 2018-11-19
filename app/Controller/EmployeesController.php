<?php

App::uses('AppController', 'Controller');

class EmployeesController extends AppController {

    var $name = "Employees";
    var $disabledAction = array(
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
        $this->_setPageInfo("admin_view", "");
    }

    function admin_index() {
        $this->contain = [
            "Biodata" => [
                "Religion",
                "Gender",
            ],
            "User",
            "Employee" => [
            ],
        ];
        $conds = $this->_filter($_GET, $this->filterCond);
        if (empty($conds)) {
            $conds = $this->defaultConds;
        }
        $conds['AND'] = am($conds, array(
                ), $this->conds);
        if ($this->order === false) {
            $this->order = 'Account.created desc';
        }
        $this->Paginator->settings = array(
            "Account" => array(
                'conditions' => $conds,
                'limit' => $this->paginate['limit'],
                'maxLimit' => $this->paginate['maxLimit'],
                'order' => $this->order,
                'recursive' => -1,
                'contain' => $this->contain,
            )
        );
        $rows = $this->Paginator->paginate("Account");
        $data = array(
            'rows' => $rows,
        );
        $this->set(compact('data'));
        $this->_activePrint(func_get_args(), "employees");
    }

    function admin_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            $password = $this->{ Inflector::classify($this->name) }->data['Account']["User"]["password"];
            $salt = hash("sha224", uniqid(mt_rand(), true), false);
            $encrypt = hash("sha512", $password . $salt, false);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                $this->{ Inflector::classify($this->name) }->data['Account']["User"]["password"] = $encrypt;
                $this->{ Inflector::classify($this->name) }->data['Account']["User"]["salt"] = $salt;
                unset($this->{ Inflector::classify($this->name) }->data['Account']["User"]["repeat_password"]);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array("deep" => true));
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
    }

    function admin_edit($id = null) {
        if ($this->request->is("post") || $this->request->is("put")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->validates()) {
                if (!is_null($id)) {
                    $this->{ Inflector::classify($this->name) }->id = $id;
                    $this->Employee->data['Employee']['id'] = $id;
                    $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                    $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id), "recursive" => 2));

                    $this->data = $rows;
                    $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id), "recursive" => 2));
            $this->data = $rows;
        }
    }

    function admin_view($id = null) {
        if (!$this->Employee->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        } else {
            $this->{ Inflector::classify($this->name) }->id = $id;
            $this->Employee->data['Employee']['id'] = $id;
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id), "recursive" => 2));
            $this->data = $rows;
        }
    }

    function admin_profil() {
        $id = $this->_getEmployeeId();
        if (!$this->Employee->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        } else {
            $this->{ Inflector::classify($this->name) }->id = $id;
            $this->Employee->data['Employee']['id'] = $id;
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id), "recursive" => 4));
            $this->data = $rows;
            $this->_activePrint(func_get_args(), "print_profile","print_profile");
        }
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function _options() {
        $this->set("religions", $this->Employee->Account->Biodata->Religion->find("list", array("fields" => array("Religion.id", "Religion.name"))));
        $this->set("genders", $this->Employee->Account->Biodata->Gender->find("list", array("fields" => array("Gender.id", "Gender.name"))));
        $this->set("states", ClassRegistry::init("State")->find("list", array("fields" => array("State.id", "State.name"))));
        $this->set("cities", ClassRegistry::init("City")->find("list", array("fields" => array("City.id", "City.name"))));
        $this->set("bloodTypes", ClassRegistry::init("BloodType")->find("list", array("fields" => array("BloodType.id", "BloodType.name"))));
        $this->set("userGroups", ClassRegistry::init("UserGroup")->find("list", array("fields" => array("UserGroup.id", "UserGroup.label"))));
        $this->set("departments", ClassRegistry::init("Department")->find("list", array("fields" => array("Department.id", "Department.name"))));
    }

    function admin_list() {
        $this->autoRender = false;
        $conds = [];
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $conds[] = array(
                "or" => array(
                    "Biodata.first_name like" => "%$q%",
                    "Biodata.last_name like" => "%$q%",
            ));
        }

        $suggestions = ClassRegistry::init("Biodata")->find("all", array(
            "conditions" => $conds,
            "contain" => array(
                "Account" => array(
                    "Employee" => array(
                        "Office",
                        "Department",
                        "UnitPosition",
                        "EmployeeClass"
                    ),
                    "User",
                )
            )
        ));
        $result = [];
        foreach ($suggestions as $item) {
            if (!empty($item['Account']['Employee'])) {
                if (in_array($item["Account"]["User"]["user_group_id"], $this->_excludedUserGroup())){
                    continue;
                }
                if (isset($this->request->query['type']) && $this->request->query['type'] == "prio") {
                    if (!in_array($item['Account']['Employee']['Office']['uniq'], ["kabid", "kasi", "kadis"])) {
                        continue;
                    }
                }
                $result[] = [
                    "id" => $item['Account']['Employee']['id'],
                    "full_name" => $item['Biodata']['full_name'],
                    "nip" => @$item['Account']['Employee']['nip_baru'],
                    "eselon" => @$item['Account']['Employee']['EmployeeClass']['name'],
                    "jabatan" => @$item['Account']['Employee']['Office']['name'],
                    "department" => @$item['Account']['Employee']['Department']['name'],
                    "department_uniq_name" => @$item['Account']['Employee']['Department']['uniq_name'],
                ];
            }
        }
        echo json_encode($result);
    }

    function admin_listprio() {
        $this->autoRender = false;
        $conds = [];
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $conds[] = array(
                "or" => array(
                    "Biodata.first_name like" => "%$q%",
                    "Biodata.last_name like" => "%$q%",
            ));
        }

        $suggestions = ClassRegistry::init("Biodata")->find("all", array(
            "conditions" => $conds,
            "contain" => array(
                "Account" => array(
                    "Employee" => array(
                        "Office",
                        "Department",
                        "UnitPosition",
                        "EmployeeClass",
                    )
                )
            )
        ));
        $result = [];
        foreach ($suggestions as $item) {
            if (!empty($item['Account']['Employee'])) {
                if (in_array($item["Account"]["User"]["user_group_id"], $this->_excludedUserGroup())){
                    continue;
                }
                if (!in_array($item['Account']['Employee']['Office']['uniq'], ["kabid", "kasi", "kadis"])) {
                    continue;
                }
                $result[] = [
                    "id" => $item['Account']['Employee']['id'],
                    "full_name" => $item['Biodata']['full_name'],
                    "nip" => @$item['Account']['Employee']['nip_baru'],
                    "eselon" => @$item['Account']['Employee']['EmployeeClass']['name'],
                    "jabatan" => @$item['Account']['Employee']['Office']['name'],
                    "department" => @$item['Account']['Employee']['Department']['name'],
                    "department_uniq_name" => @$item['Account']['Employee']['Department']['uniq_name'],
                ];
            }
        }
        echo json_encode($result);
    }

}
