<?php

App::uses('AppController', 'Controller');

class RolesController extends AppController {

    var $name = "Roles";
    var $disabledAction = array(
        "admin_add",
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Hak Akses");
        $this->_setPageInfo("admin_edit", "Ubah Hak Akses");
    }

    function admin_index() {
        $conds = $this->_filter($_GET, $this->filterCond);
        if (empty($conds)) {
            $conds = $this->defaultConds;
        }
        $conds['AND'] = am($conds, array(
                ), $this->conds);
        $this->Paginator->settings = array(
            "UserGroup" => array(
                'conditions' => $conds,
                'limit' => $this->paginate['limit'],
                'maxLimit' => $this->paginate['maxLimit'],
                'recursive' => -1,
                'contain' => [
                    "Role" => [
                        "Menu" => [
                            "SubMenu" => [
                                "RoleSubMenu",
                            ],
                        ],
                    ],
                ],
            )
        );
        $rows = $this->Paginator->paginate($this->Role->UserGroup);
        $data = array(
            'rows' => $rows,
        );
        $this->set(compact('data'));
    }

    function admin_edit($id = null) {
        if ($this->request->is("post") || $this->request->is("put")) {
            if (!is_null($id)) {
                foreach ($this->data['Role'] as $item) {
                    if (!isset($item['id'])) {
                        $this->Role->create();
                        $this->Role->save(am(array("user_group_id" => $id), $item));
                    } else {
                        $this->Role->id = $item['id'];
                        $this->Role->save(am(array("user_group_id" => $id), $item));
                    }
                }
                $roleSubMenuModel = ClassRegistry::init("RoleSubMenu");
                foreach ($this->data["RoleSubMenu"] as $roleSubMenu) {
                    if (!isset($roleSubMenu['id'])) {
                        $roleSubMenuModel->create();
                        $roleSubMenuModel->save(am(array("user_group_id" => $id), $roleSubMenu));
                    } else {
                        $roleSubMenuModel->id = $roleSubMenu['id'];
                        $roleSubMenuModel->save(am(array("user_group_id" => $id), $roleSubMenu));
                    }
                }
                $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                
            }
        } else {
            $row = $this->{ Inflector::classify($this->name) }->UserGroup->find("first", array('conditions' => array("UserGroup.id" => $id)));
            $dataMenu = $this->Role->Menu->find('all', [
                'order' => [
                    'Menu.label' => 'ASC'
                ],
                "recursive" => -1,
                "contain" => [
                    "Role" => [
                        "conditions" => [
                            "Role.user_group_id" => $id
                        ]
                    ],
                    "SubMenu" => [
                        "conditions" => [
                            "SubMenu.parent_id" => null,
                        ],
                        "RoleSubMenu" => [
                            "conditions" => [
                                "RoleSubMenu.user_group_id" => $id,
                            ],
                        ],
                    ],
                ]
            ]);
            foreach ($dataMenu as $i => &$menu) {
                $this->_appendChildMenu($menu["SubMenu"], $id);
            }
            $row['Role']['id'] = $id;
            $this->data = $row;
            $this->set("dataMenu", $dataMenu);
        }
    }

    function _appendChildMenu(&$subMenus = [], $user_group_id = null) {
        $modelSubMenu = ClassRegistry::init("SubMenu");
        foreach ($subMenus as $j => $subMenu) {
            $sub_menu_id = isset($subMenu["id"]) ? $subMenu["id"] : $subMenu["SubMenu"]["id"];
            $childSubMenus = $modelSubMenu->find("all", [
                "conditions" => [
                    "SubMenu.parent_id" => $sub_menu_id,
                ],
                "contain" => [
                    "RoleSubMenu" => [
                        "conditions" => [
                            "RoleSubMenu.user_group_id" => $user_group_id,
                        ],
                    ],
                ],
            ]);
            $this->_appendChildMenu($childSubMenus, $user_group_id);
            $subMenus[$j]["Children"] = $childSubMenus;
        }
    }

}
