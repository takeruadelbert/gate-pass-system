<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::import('Vendor', 'wonolib');
App::import('Vendor', 'seourl');
App::import('Vendor', 'terbilang');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $helpers = array(
        'Html',
        'Form',
        'Text',
        'Js',
        'Session',
        'Number',
        'JqueryEngine',
        "StnAdmin",
        'Echo',
        "Sidispop",
        "Engine",
        "Calculator",
    );
    var $components = array(
        'Session',
        'RequestHandler',
        'Email',
        'Paginator',
        'DebugKit.Toolbar',
    );
    /*
     * 
     * @template
     * - londium
     * - pages-ace
     * - londiniumv
     */
    var $template = "londiniumv";
    var $frontTemplate = "stn_default";
    var $statusCode = array(
        101 => "Harap mengisi kembali data yang salah dibawah",
        200 => "Berhasil disimpan",
        201 => "Login berhasil",
        202 => "Berhasil diubah",
        203 => "Silahkan pilih salah satu atau lebih data terlebih dahulu",
        204 => "Data berhasil dihapus",
        205 => "Options found",
        206 => "Ok",
        207 => "Status berubah",
        400 => "Invalid request",
        401 => "Data not found",
        402 => "Login gagal",
        403 => "Auth needed",
        404 => "Unable to connect to 3rd party",
        405 => "Fail",
        410 => "Mesin Absensi Tidak Ada",
        411 => "Tidak dapat terhubung dengan mesin absensi",
        501 => "Kode Voucher Berlaku",
        502 => "Kode Voucher Tidak Berlaku",
    );
    var $emailAcc = array(
        'NoReply' => array(
            'port' => 26,
            'timeout' => 60,
            'host' => 'mail.dispopsulbar.com',
            'username' => 'noreply@dispopsulbar.com',
            'password' => 'adminilugroup123',
            'transport' => 'Smtp',
        ),
    );
    var $pageInfo = array();
    var $disabledAction = array();
    var $paginate = array(
        "limit" => 10,
        "maxLimit" => 5000,
    );
    var $constantString = array(
        "pagination-tips" => "locale0001"
    );
    var $contain = array(
    );
    var $conds = array(
    );
    var $defaultConds = array(
    );
    var $filterCond = "AND";
    var $args = false;
    var $cetak_template = false;
    var $order = false;
    var $layoutCetak = false;

    function _sentEmail($type = null, $info = array(), $options = array(), $sent = true) {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        if (!empty($type)) {
            switch ($type) {
                case 'forgot-password':
                    $Email->template('forgot-password');
                    $viewvar = $info['item'];
                    break;
            }
            $Email->viewVars($viewvar);
            $Email->emailFormat('html');
            $Email->to($info['tujuan']);
            $Email->subject($info['subject']);
            $Email->from($info['from']);
            $Email->config($this->emailAcc[$info['acc']]);
            $Email->send();
        }
    }

    function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        $this->pageInfo = array(
            "index" => array(
                'titlePage' => __("Index"),
                'descriptionPage' => __(""),
            ),
            "add" => array(
                'titlePage' => __("Tambah"),
                'descriptionPage' => __(""),
            ),
            "edit" => array(
                'titlePage' => __("Ubah"),
                'descriptionPage' => __(""),
            ),
            "admin_index" => array(
                'titlePage' => __("Index"),
                'descriptionPage' => __(""),
            ),
            "admin_add" => array(
                'titlePage' => __("Tambah"),
                'descriptionPage' => __(""),
            ),
            "admin_edit" => array(
                'titlePage' => __("Ubah"),
                'descriptionPage' => __(""),
            ),
            "default" => array(
                'titlePage' => __("Selamat Datang"),
                'descriptionPage' => __(""),
            ),
        );
    }

    function _excludedUserGroup() {
        return ClassRegistry::init("UserGroup")->excludedUserGroup();
    }

    function beforeFilter() {
//        $this->__setVar();
        $this->_listLang();
        $this->_setLang();
        $this->__checkPremission();
        $this->__checkRoleAccess();
        $this->_setCKConfig();
        if (!$this->request->is('ajax')) {
            $this->set('leftSideMenuData', $this->_createLeftMenu());
        }
        if (in_array($this->params['action'], $this->disabledAction)) {
            $this->_404();
        }
    }

    function beforeRender() {
        Configure::write("template", $this->template);
        Configure::write("frontTemplate", $this->frontTemplate);
        if (isset($this->jump) && $this->jump) {
            
        } else {
            global $URL, $ACTION_URL, $MID;
            if (isset($this->cetak)) {
                $this->layout = "cetak/" . $this->layoutCetak;
            } else if ($this->params['admin']) {
                $this->layout = _TEMPLATE_DIR . "/{$this->template}/default";
            } else if ($this->params['front'] || $this->params['member']) {
                $this->layout = _FRONT_TEMPLATE_DIR . "/{$this->frontTemplate}/default";
            }
            if ($this->request->is('ajax')) {
                $this->layout = 'ajax';
            }
            //For breadcrumb system
            $camelController = Inflector::camelize($this->params['controller']);
            $underController = Inflector::underscore($this->params['controller']);
            $otherController = Inflector::variable(Inflector::pluralize($camelController));
            $target = [
                "{$this->params['prefix']}/{$camelController}/{$this->_pureAction()}",
                "{$this->params['prefix']}/{$underController}/{$this->_pureAction()}",
                "{$this->params['prefix']}/{$otherController}/{$this->_pureAction()}",
            ];
            if ($this->_pureAction() == "index") {
                $target = am([
                    "{$this->params['prefix']}/{$camelController}",
                    "{$this->params['prefix']}/{$underController}",
                    "{$this->params['prefix']}/{$otherController}",
                        ], $target);
            }
            $reversedUrl = Router::url([
                        "controller" => $underController,
                        "action" => $this->_pureAction(),
                        "prefix" => $this->params['prefix'],
            ]);
            $reversedUrl = str_replace_first(Router::url("/"), "", $reversedUrl);
            $target[] = $reversedUrl;
            $target[] = $this->params->url;
            $bcSuggestion = array();
            if (!empty($this->request->query["mID"])) {
                $MID = $this->request->query["mID"];
            } else {
                parse_str(parse_url($this->referer(), PHP_URL_QUERY), $query);
                $MID = !empty($query["mID"]) ? $query["mID"] : false;
            }
            $staticMenu = [
                "admin/dashboard",
                "admin/employees/profil",
                "admin/accounts/change_password",
            ];
            if (!empty(array_intersect($staticMenu, $target))) {
                $MID = false;
            }
            $moduleLink = ClassRegistry::init("ModuleLink")->find("first", [
                "conditions" => [
                    "ModuleLink.alias" => $target,
                ]
            ]);
            if (!empty($moduleLink)) {
                $bcSuggestion[] = [
                    "label" => $moduleLink['ModuleLink']['name'],
                    "alias" => $moduleLink["ModuleLink"]['alias'],
                ];
            }
            if ($MID !== false) {
                $explodedMID = explode("_", $MID);
                switch ($explodedMID[0]) {
                    case "menu":
                        $menu_id = @$explodedMID[1];
                        $bcSuggestion[] = $this->_buildMenuBC($menu_id);
                        break;
                    case "submenu":
                        $sub_menu_id = @$explodedMID[1];
                        $bcSuggestion = am($bcSuggestion, $this->_buildSubMenuBC($sub_menu_id));
                        break;
                }
            }
            //end of breadcrumb system
            //For pageInfo system
            $pageInfo = isset($this->pageInfo[$this->params['action']]) ? $this->pageInfo[$this->params['action']] : $this->pageInfo["default"];
            //end of pageInfo system

            $template = $this->template;
            $frontTemplate = $this->frontTemplate;
            $controller = Inflector::camelize($this->params['controller']);
            $action = $this->params['action'];
            $URL = $url = trim(preg_replace('/limit:[0-9]*/', '', preg_replace('/page:[0-9]*/', '', $this->request->url, 1), 1), "/");
            $ACTION_URL = "{$this->params['prefix']}/{$controller}/{$this->_pureAction()}";
            $constantString = $this->constantString;
            $this->set(compact('bcSuggestion', 'template', 'frontTemplate', 'controller', 'action', 'url', 'pageInfo', 'constantString', "ACTION_URL", "MID"));
            if (isset($this->cetak)) {
                $this->view = "/Modules/admin_print";
            } else if ($this->params['admin']) {
                $this->view = "/Modules/admin_dispatcher";
            }
        }
    }

    function _buildSubMenuBC($sub_menu_id = null) {
        $bc = [];
        $currentSubMenu = ClassRegistry::init("SubMenu")->find("first", [
            "conditions" => [
                "SubMenu.id" => $sub_menu_id,
            ]
        ]);
        $alias = empty($currentSubMenu["Module"]['alias']) ? "" : $currentSubMenu["Module"]['alias'] . "?mID=submenu_{$currentSubMenu["SubMenu"]["id"]}";
        $bc[] = array(
            "label" => $currentSubMenu['SubMenu']['label'],
            "alias" => $alias,
        );
        if (!empty($currentSubMenu["SubMenu"]["parent_id"])) {
            $bc = am($bc, $this->_buildSubMenuBC($currentSubMenu["SubMenu"]["parent_id"]));
        } else if (!empty($currentSubMenu["SubMenu"]["menu_id"])) {
            $bc[] = $this->_buildMenuBC($currentSubMenu["SubMenu"]["menu_id"]);
        }
        return $bc;
    }

    function _buildMenuBC($menu_id = null) {
        $currentMenu = ClassRegistry::init("Menu")->find("first", [
            "conditions" => [
                "Menu.id" => $menu_id,
            ],
            "contain" => [
                "Module" => [
                    "ModuleLink",
                ],
            ]
        ]);
        return array(
            "label" => $currentMenu['Menu']['label'],
            "alias" => $currentMenu["Module"]['alias'] . "?mID=menu_{$currentMenu["Menu"]["id"]}",
            "icon" => $currentMenu['Menu']['class_icon'],
        );
    }

    function __checkPremission() {
        $credential = $this->Session->read("credential.{$this->params['prefix']}");
        if ($this->params['prefix'] == "front") {
            
        } else if (!empty($this->params['prefix']) && empty($credential)) {
            if ($this->params['prefix'] == "member") {
                $this->redirect('/', 401);
            } else {
                $this->redirect('/' . $this->params['prefix'], 401);
            }
        }
    }

    function _createLeftMenu() {
        $user_group_id = $this->Session->read("credential.admin.User.user_group_id");
        $cond = array(
            'Role.user_group_id' => $user_group_id,
            'Role.accessible' => 1,
        );
        $getRoleData = ClassRegistry::init('Role')->find('all', array(
            'recursive' => -1,
            'conditions' => $cond,
//            'group' => array('Role.module_id'),
            'contain' => array(
                "Menu" => array(
                    "Module" => [
                        "ModuleLink"
                    ],
                    "SubMenu" => [
                        "Module" => [
                            "ModuleLink",
                        ]
                    ]
                ),
            ),
            "order" => "Menu.ordering_number",
        ));
        $roleData = array();

        foreach ($getRoleData as $role) {
            $box = array(
                "label" => $role['Menu']['label'],
                "icon" => $role['Menu']['class_icon'],
                "alias" => @$role["Menu"]['Module']['alias'],
                "moduleLink" => !isset($role["Menu"]['Module']['ModuleLink']) ? [] : $role["Menu"]['Module']['ModuleLink'],
                "content" => array(),
                "menuId" => $role["Menu"]["id"],
            );
            $submenu = ClassRegistry::init('SubMenu')->find("all", array(
                "order" => "SubMenu.ordering_number",
                "conditions" => array(
                    "SubMenu.menu_id" => $role['Menu']['id'],
                    "OR" => array(
                        "SubMenu.parent_id is null",
                        "SubMenu.parent_id" => 0
                    )
                ),
                "contain" => [
                    "Module" => [
                        "ModuleLink",
                    ],
                    "RoleSubMenu" => [
                        "conditions" => [
                            "RoleSubMenu.user_group_id" => $user_group_id,
                            "RoleSubMenu.accessible" => 1,
                        ]
                    ],
                ],
            ));
            foreach ($submenu as $sb) {
                if (isset($sb["RoleSubMenu"][0])) {
                    $ml = [];
                    if (!empty($sb['Module']["ModuleLink"])) {
                        foreach ($sb['Module']["ModuleLink"] as $moduleLink) {
                            $ml[] = $moduleLink['alias'];
                        }
                    }
                    $box['content'][] = array(
                        "label" => $sb['SubMenu']['label'],
                        "alias" => $sb['Module']['alias'],
                        "moduleLink" => $ml,
                        "content" => $this->_subMenu($sb, $user_group_id),
                        "submenuId" => $sb["SubMenu"]["id"],
                    );
                }
            }
            $roleData[] = $box;
        }
        return $roleData;
    }

    function _subMenu($parent, $user_group_id = 0) {
        $result = array();
        $menu = ClassRegistry::init('SubMenu')->find("all", array(
            "conditions" => array(
                "SubMenu.parent_id" => $parent['SubMenu']['id']
            ),
            "order" => "SubMenu.ordering_number asc",
            "contain" => [
                "Module" => [
                    "ModuleLink",
                ],
                "RoleSubMenu" => [
                    "conditions" => [
                        "RoleSubMenu.user_group_id" => $user_group_id,
                        "RoleSubMenu.accessible" => 1,
                    ]
                ],
            ],
        ));
        if (!empty($menu)) {
            foreach ($menu as $subMenu) {
                if (isset($subMenu["RoleSubMenu"][0])) {
                    $ml = [];
                    if (is_array(@$subMenu['Module']['ModuleLink'])) {
                        foreach ($subMenu['Module']['ModuleLink'] as $moduleLink) {
                            $ml[] = $moduleLink['alias'];
                        }
                    }
                    $result[] = array(
                        "label" => $subMenu['SubMenu']['label'],
                        "alias" => $subMenu['Module']['alias'],
                        "moduleLink" => $ml,
                        "content" => $this->_subMenu($subMenu, $user_group_id),
                        "submenuId" => $subMenu["SubMenu"]["id"],
                    );
                }
            }
        }
        return $result;
    }

    function _filter($get, $paramCond = 'AND') {
        $cond = array();
        foreach ($get as $k => $v) {
            if ($k == "mID") {
                continue;
            }
            $key = preg_replace('/_/', '.', $k, 1);
            if (substr_count($key, 'select') == 1) {
                $key = preg_replace('/select./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v) || strlen($v)) {
                    $cond[$paramCond][$key] = $v;
                }
            } elseif (substr_count($key, 'awal') == 1) {
                $key = preg_replace('/awal\./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v) || strlen($v)) {
                    $cond[$paramCond]['DATE(' . $key . ') >= '] = $v;
                }
            } else if (substr_count($key, 'akhir') == 1) {
                $key = preg_replace('/akhir\./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v) || strlen($v)) {
                    $cond[$paramCond]['DATE(' . $key . ') <= '] = $v;
                }
            } else {
                if (!empty($v) || strlen($v)) {
                    if ($key == "Biodata.first_name") {
                        $cond[$paramCond]["or"][]['Biodata.last_name LIKE '] = '%' . $v . '%';
                        $cond[$paramCond]["or"][][$key . ' LIKE '] = '%' . $v . '%';
                    } else {
                        $cond[$paramCond][][$key . ' LIKE '] = '%' . $v . '%';
                    }
                }
            }
        }
        $this->set("cond", $cond);
        return $cond;
    }

    function _pureAction() {
        return ltrim(ltrim($this->params['action'], "/{$this->params['prefix']}/"), "_");
    }

    function _generateStatusCode($id, $message = null, $data = array()) {
        if (is_null($message)) {
            return array("status" => $id, "message" => $this->statusCode[$id], 'data' => $data);
        } else {
            return array("status" => $id, "message" => $message, 'data' => $data);
        }
    }

    function _listLang() {
        $all = ClassRegistry::init("Language")->find("all");
        $lang = array();
        foreach ($all as $i) {
            $lang[$i['Language']['code']] = array(
                "icon" => $i['Language']['icon'],
                "name" => $i['Language']['name'],
            );
        }
        $this->set("langs", $lang);
    }

    function _setCKConfig() {
        $this->Session->write("sck.baseUrl", Router::url("/", true));
        $this->Session->write("sck.root", WWW_ROOT);
        $this->Session->write("sck.folder", "upload" . DS);
    }

    function _setLang() {
        if ($this->Session->check("Config.language")) {
            Configure::write("Config.language", $this->Session->read("Config.language"));
        }
        $this->Session->write("wonomultilang.lang", Configure::read("Config.language"));
    }

    //Start Main Basic CRUD Engine
    function _setPageInfo($action = null, $titlePage = "", $descriptionPage = "") {
        $this->pageInfo[$action] = array(
            'titlePage' => __($titlePage),
            'descriptionPage' => __($descriptionPage),
        );
    }

    function _activePrint($args = false, $filename = false, $layoutCetak = false) {
        if ($args === false) {
            $args = func_get_args();
        }
        if (!empty($args) && !empty($k = array_intersect(["print", "excel", "pdf"], $args))) {
            $jenis = array_shift($k);
            $this->cetak = $jenis;
            if ($layoutCetak !== false) {
                if (is_array($layoutCetak)) {
                    $this->layoutCetak = $layoutCetak[$jenis];
                } else {
                    $this->layoutCetak = $layoutCetak;
                }
            } else {
                $this->layoutCetak = $jenis;
            }
            $this->set("printfile", $filename);
            $this->set("jeniscetak", $jenis);
            $this->paginate["limit"] = 10000;
            $this->paginate["maxLimit"] = 10000;
        }
    }

    function admin_index() {
        $conds = $this->_filter($_GET, $this->filterCond);
        if (empty($conds)) {
            $conds = $this->defaultConds;
        }
        $conds['AND'] = am($conds, array(
                ), $this->conds);
        if ($this->order === false) {
            $this->order = Inflector::classify($this->name) . '.created desc';
        }
        $this->Paginator->settings = array(
            Inflector::classify($this->name) => array(
                'conditions' => $conds,
                'limit' => $this->paginate['limit'],
                'maxLimit' => $this->paginate['maxLimit'],
                'order' => $this->order,
                'recursive' => -1,
                'contain' => $this->contain,
            )
        );
        $rows = $this->Paginator->paginate($this->{ Inflector::classify($this->name) });
        $data = array(
            'rows' => $rows,
//            'rows' => [],
        );
        $this->set(compact('data'));
//        if ($this->args === false) {
//            $args = func_get_args();
//        } else {
//            $args = $this->args;
//        }
//        if (isset($args[0])) {
//            $jenis = $args[0];
//            $this->cetak = $jenis;
//                $this->render($this->cetak_template);
//        }
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
                        $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                        $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        
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
                    'recursive' => 2
                ));
                $this->data = $rows;
            }
        }
    }

    function admin_multiple_delete() {
        $this->{ Inflector::classify($this->name) }->set($this->data);
        if (empty($this->data)) {
            $code = 203;
        } else {
            $allData = $this->data[Inflector::classify($this->name)]['checkbox'];
            foreach ($allData as $data) {
                if ($data != '' || $data != 0) {
                    $this->{ Inflector::classify($this->name) }->delete($data, true);
                }
            }
            $code = 204;
        }
        echo json_encode($this->_generateStatusCode($code));
        die();
    }

    function admin_delete($id = null) {
        if ($this->request->is("delete")) {
            if ($this->{ Inflector::classify($this->name) }->delete($id)) {
                $code = 204;
            } else {
                $code = 401;
            }
        } else {
            $code = 400;
        }
        echo json_encode($this->_generateStatusCode($code));
        die();
    }

    //End Main Basic CRUD Engine
    function _404() {
        die();
    }

    function _adminOnly() {
        if (!$this->_isAdmin()) {
            $this->redirect("/admin/restriction");
        }
    }

    function _isAdmin() {
        return $this->Session->read("credential.admin.User.user_group_id") == 1 ? true : false;
    }

    function _getEmployeeId() {
        return $this->Session->read("credential.admin.Employee.id");
    }

    function _getDepartmentId() {
        return $this->Session->read("credential.admin.Employee.department_id");
    }

    //hanya berlaku untuk default routing
    //TO-DO: custome routing
    function __checkRoleAccess() {
        $skippedAlias = [
            "admin/restriction",
            "admin/dashboard",
            "admin/accounts/change_password",
            "admin/accounts/edit_profile",
            "admin/asset_files/getfile",
            "admin/popups/content",
            "admin/employees/profil",
            "admin/employees/list",
            "admin/employees/listprio",
        ];
        $camelController = Inflector::camelize($this->params['controller']);
        $underController = Inflector::underscore($this->params['controller']);
        $otherController = Inflector::variable(Inflector::pluralize($camelController));
        $target = [
            "{$this->params['prefix']}/{$camelController}/{$this->_pureAction()}",
            "{$this->params['prefix']}/{$underController}/{$this->_pureAction()}",
            "{$this->params['prefix']}/{$otherController}/{$this->_pureAction()}",
        ];
        if ($this->_pureAction() == "index") {
            $target = am([
                "{$this->params['prefix']}/{$camelController}",
                "{$this->params['prefix']}/{$underController}",
                "{$this->params['prefix']}/{$otherController}",
                    ], $target);
        }

        $reversedUrl = Router::url([
                    "controller" => $underController,
                    "action" => $this->_pureAction(),
                    "prefix" => $this->params['prefix'],
        ]);
        $reversedUrl = str_replace_first(Router::url("/"), "", $reversedUrl);
        $target[] = $reversedUrl;
        $target[] = $this->params->url;

        if ($this->params['prefix'] == "admin" && !$this->_isAdmin() && !in_array($this->params->url, $skippedAlias) && empty(array_intersect($target, $skippedAlias))) {
            $userGroupId = $this->Session->read("credential.admin.User.user_group_id");
            $modules = ClassRegistry::init("Module")->find("all", [
                "conditions" => [
                    "Module.alias" => $target,
                ],
                "recursive" => -1,
            ]);
            $moduleLinks = ClassRegistry::init("ModuleLink")->find("all", [
                "conditions" => [
                    "ModuleLink.alias" => $target,
                ],
                "recursive" => -1,
            ]);
            $moduleId = [];
            if (!empty($moduleLinks)) {
                $moduleId = am(array_column(array_column($moduleLinks, "ModuleLink"), "module_id"), $moduleId);
            }
            if (!empty($modules)) {
                $moduleId = am(array_column(array_column($modules, "Module"), "id"), $moduleId);
            }
            $menus = ClassRegistry::init("Menu")->find("all", [
                "conditions" => [
                    "Menu.module_id" => $moduleId,
                    "NOT" => [
                        "Menu.module_id" => null,
                    ],
                ],
                "recursive" => -1,
            ]);
            $subMenus = ClassRegistry::init("SubMenu")->find("all", [
                "conditions" => [
                    "SubMenu.module_id" => $moduleId,
                    "NOT" => [
                        "SubMenu.module_id" => null,
                    ],
                ],
                "recursive" => -1,
            ]);
            if (!empty($subMenus)) {
                $subMenuId = array_column(array_column($subMenus, "SubMenu"), "id");
                $roleSubMenu = ClassRegistry::init("RoleSubMenu")->find("first", [
                    "conditions" => [
                        "RoleSubMenu.user_group_id" => $userGroupId,
                        "RoleSubMenu.sub_menu_id" => $subMenuId,
                        "RoleSubMenu.accessible" => 1,
                    ],
                    "recursive" => -1
                ]);
                if (empty($roleSubMenu)) {
                    $this->redirect("/admin/restriction");
                }
                $this->set("roleAccess", [
                    "edit" => $roleSubMenu["RoleSubMenu"]['edit'],
                    "add" => $roleSubMenu["RoleSubMenu"]['add'],
                    "delete" => $roleSubMenu["RoleSubMenu"]['delete'],
                ]);
            } else if (!empty($menus)) {
                $menuId = array_column(array_column($menus, "Menu"), "id");
                $role = ClassRegistry::init("Role")->find("first", [
                    "conditions" => [
                        "Role.user_group_id" => $userGroupId,
                        "Role.menu_id" => $menuId,
                        "Role.accessible" => 1,
                    ],
                    "recursive" => -1
                ]);
                if (empty($role)) {
                    $this->redirect("/admin/restriction");
                }
                $this->set("roleAccess", [
                    "edit" => $role["Role"]['edit'],
                    "add" => $role["Role"]['add'],
                    "delete" => $role["Role"]['delete'],
                ]);
            } else {
                $this->redirect("/admin/restriction");
            }
        } else {
            $this->set("roleAccess", [
                "edit" => true,
                "add" => true,
                "delete" => true,
            ]);
        }
    }

}
