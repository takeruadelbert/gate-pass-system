<?php

class AccountsController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Akun");
        $this->_setPageInfo("admin_add", "Tambah Akun");
        $this->_setPageInfo("admin_edit", "Edit Akun");
        $this->_setPageInfo("admin_edit_profile", "Edit Akun");
        $this->_setPageInfo("admin_restriction", "Terlarang");
        $this->_setPageInfo("admin_change_password", "Ganti password");
    }

    function admin_dashboard() {
        
    }

    function admin_index() {
        $this->contain = [
            "User",
            "Biodata",
            "AccountStatus",
        ];
        parent::admin_index();
        $this->set("userGroups", ClassRegistry::init("UserGroup")->find("list", array("fields" => array("UserGroup.id", "UserGroup.label"))));
        $this->_activePrint(func_get_args(), "data_pengguna");
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

    function admin_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
            $salt = hash("sha224", uniqid(mt_rand(), true), false);
            $encrypt = hash("sha512", $password . $salt, false);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                $this->{ Inflector::classify($this->name) }->data["User"]["salt"] = $salt;
                unset($this->{ Inflector::classify($this->name) }->data["User"]["repeatPassword"]);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data);
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
        $this->set("accountStatuses", $this->{ Inflector::classify($this->name) }->AccountStatus->find("list", array("fields" => array("AccountStatus.id", "AccountStatus.name"))));
        $this->set("genders", $this->{ Inflector::classify($this->name) }->Biodata->Gender->find("list", array("fields" => array("Gender.id", "Gender.name"))));
        $this->set("countries", $this->{ Inflector::classify($this->name) }->Biodata->Country->find("list", array("fields" => array("Country.id", "Country.name"), "conditions" => array("Country.id" => 100))));
        $this->set("states", $this->{ Inflector::classify($this->name) }->Biodata->State->find("list", array("fields" => array("State.id", "State.name"))));
        $this->set("userGroups", $this->{ Inflector::classify($this->name) }->User->UserGroup->find("list", array("fields" => array("UserGroup.id", "UserGroup.label"))));
        $this->set("identityTypes", $this->{ Inflector::classify($this->name) }->Biodata->IdentityType->find("list", array("fields" => array("IdentityType.id", "IdentityType.name"))));
    }

    function admin_edit($id = null) {
        if ($this->request->is("post") || $this->request->is("put")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->validates()) {
                if (!is_null($id)) {
                    $this->{ Inflector::classify($this->name) }->id = $id;
                    $this->Account->data['Account']['id'] = $id;
                    $this->{ Inflector::classify($this->name) }->saveAll();
                    $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id)));
                    $this->data = $rows;
                    $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id)));
            $this->data = $rows;
        }
        $this->set("accountStatuses", $this->{ Inflector::classify($this->name) }->AccountStatus->find("list", array("fields" => array("AccountStatus.id", "AccountStatus.name"))));
        $this->set("identityTypes", $this->{ Inflector::classify($this->name) }->Biodata->IdentityType->find("list", array("fields" => array("IdentityType.id", "IdentityType.name"))));
        $this->set("genders", $this->{ Inflector::classify($this->name) }->Biodata->Gender->find("list", array("fields" => array("Gender.id", "Gender.name"))));
        $this->set("countries", $this->{ Inflector::classify($this->name) }->Biodata->Country->find("list", array("fields" => array("Country.id", "Country.name"), "conditions" => array("Country.id" => 100))));
        $this->set("states", $this->{ Inflector::classify($this->name) }->Biodata->State->find("list", array("fields" => array("State.id", "State.name"))));
        $this->set("userGroups", $this->{ Inflector::classify($this->name) }->User->UserGroup->find("list", array("fields" => array("UserGroup.id", "UserGroup.name"))));
        $this->set("cities", $this->{ Inflector::classify($this->name) }->Biodata->City->find("list", array("conditions" => array("City.state_id" => $this->data['Biodata']['state_id']))));
    }

    function admin_delete($id = null) {
        if ($this->request->is("delete")) {
            if ($this->{ Inflector::classify($this->name) }->delete($id)) {
                $code = 204;
            } else {
                $code = 400;
            }
        } else {
            $code = 400;
        }
        echo json_encode($this->_generateStatusCode($code));
        die();
    }

    function login_admin() {
        if (!empty($this->Session->read("credential.admin"))) {
            $this->redirect("/admin/dashboard");
        }
        $loginCredential = ClassRegistry::init("LoginPageCredential")->find("list", [
            "conditions" => [
                "LoginPage.name" => "im",
                "LoginPageCredential.access" => true,
            ],
            "fields" => [
                "LoginPageCredential.user_group_id",
            ],
            "contain" => [
                "LoginPage",
            ]
        ]);
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("recursive" => 3, "conditions" => array("OR" => array("User.email" => $this->data['Account']['username'], "User.username" => $this->data['Account']['username']))));
            if (!empty($data)) {
                if ($this->_testPassword($this->data['Account']['password'], $data['User']['salt'], $data['User']['password'])) {
                    if (in_array($data['User']['user_group_id'], $loginCredential)) {
                        $this->Session->write("credential.admin", $data);
                        $this->Session->write("currentlogin", "im");
                        $this->redirect("/admin/dashboard");
                    } else {
                        $this->Session->setFlash(__("Anda tidak mempunyai akses ke halaman ini."), 'default', array(), 'warning');
                    }
                } else {
                    $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warning');
                }
            } else {
                $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warning');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login";
    }

    function login_utama() {
        if (!empty($this->Session->read("credential.admin"))) {
            $this->redirect("/admin/dashboard");
        }
        $loginCredential = ClassRegistry::init("LoginPageCredential")->find("list", [
            "conditions" => [
                "LoginPage.name" => "im",
                "LoginPageCredential.access" => true,
            ],
            "fields" => [
                "LoginPageCredential.user_group_id",
            ],
            "contain" => [
                "LoginPage",
            ]
        ]);
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("recursive" => 3, "conditions" => array("OR" => array("User.email" => $this->data['Account']['username'], "User.username" => $this->data['Account']['username']))));
            if (!empty($data)) {
                if ($this->_testPassword($this->data['Account']['password'], $data['User']['salt'], $data['User']['password'])) {
                    if (in_array($data['User']['user_group_id'], $loginCredential)) {
                        $this->Session->write("credential.admin", $data);
                        $this->Session->write("currentlogin", "im");
                        $this->redirect("/admin/dashboard");
                    } else {
                        $this->Session->setFlash(__("Anda tidak mempunyai akses ke halaman ini."), 'default', array(), 'warninglogin');
                    }
                } else {
                    $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
                }
            } else {
                $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_utama";
        $this->set("title", "Login Sistem Informasi Manajemen");
    }

    function lupa_password_admin() {
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("contain" => array("PasswordReset", "User", "Biodata"), "conditions" => array("OR" => array("User.email" => $this->data['User']['email']))));
            if (!empty($data)) {
                $token = hash("sha256", uniqid(mt_rand(), true), false);

                $this->Account->data['Account']['id'] = $data['Account']['id'];
                $this->Account->data['PasswordReset']['id'] = $data['PasswordReset']['id'];
                $this->Account->data['PasswordReset']['token'] = $token;
                $this->Account->data['PasswordReset']['expire'] = date("Y-m-d H:i:s", time() + (24 * 3600));
                $this->Account->data['PasswordReset']['is_used'] = false;
                $this->Account->saveAll();
                $this->_sentEmail("forgot-password", [
                    "tujuan" => $this->data['User']['email'],
                    "subject" => "SIDISPOP - Reset Password",
                    "from" => array("noreply@dispopsulbar.com" => "SIDISPOP"),
                    "acc" => "NoReply",
                    "item" => [
                        'token' => $token,
                        'username' => $data['User']['username'],
                    ],
                ]);
                $this->Session->setFlash(__("Silahkan mengecek email anda"), 'default', array(), 'successlupapassword');
                $this->redirect("/admin#lupa-password");
            } else {
                $this->Session->setFlash(__("Email tidak terdaftar"), 'default', array(), 'warninglupapassword');
                $this->redirect("/admin#lupa-password");
            }
        } else {
            $this->redirect("/admin");
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login";
    }

    function login_utama_lupa_password() {
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("contain" => array("PasswordReset", "User", "Biodata"), "conditions" => array("OR" => array("User.email" => $this->data['User']['email']))));
            if (!empty($data)) {
                $token = hash("sha256", uniqid(mt_rand(), true), false);

                $this->Account->data['Account']['id'] = $data['Account']['id'];
                $this->Account->data['PasswordReset']['id'] = $data['PasswordReset']['id'];
                $this->Account->data['PasswordReset']['token'] = $token;
                $this->Account->data['PasswordReset']['expire'] = date("Y-m-d H:i:s", time() + (24 * 3600));
                $this->Account->data['PasswordReset']['is_used'] = false;
                $this->Account->saveAll();
                $this->_sentEmail("forgot-password", [
                    "tujuan" => $this->data['User']['email'],
                    "subject" => "SIDISPOP - Reset Password",
                    "from" => array("noreply@dispopsulbar.com" => "SIDISPOP"),
                    "acc" => "NoReply",
                    "item" => [
                        'token' => $token,
                        'username' => $data['User']['username'],
                    ],
                ]);
                $this->Session->setFlash(__("Silahkan mengecek email anda"), 'default', array(), 'successlupapassword');
                $this->redirect("/admin/lupa-password");
            } else {
                $this->Session->setFlash(__("Email tidak terdaftar"), 'default', array(), 'warninglupapassword');
                $this->redirect("/admin/lupa-password");
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_utama";
        $this->set("title", "Lupa Password");
    }

    function login_persuratan() {
        if (!empty($this->Session->read("credential.admin"))) {
            $this->redirect("/admin/dashboard");
        }
        $loginCredential = ClassRegistry::init("LoginPageCredential")->find("list", [
            "conditions" => [
                "LoginPage.name" => "persuratan",
                "LoginPageCredential.access" => true,
            ],
            "fields" => [
                "LoginPageCredential.user_group_id",
            ],
            "contain" => [
                "LoginPage",
            ]
        ]);
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("recursive" => 3, "conditions" => array("OR" => array("User.email" => $this->data['Account']['username'], "User.username" => $this->data['Account']['username']))));
            if (!empty($data)) {
                if ($this->_testPassword($this->data['Account']['password'], $data['User']['salt'], $data['User']['password'])) {
                    if (in_array($data['User']['user_group_id'], $loginCredential)) {
                        $this->Session->write("credential.admin", $data);
                        $this->Session->write("currentlogin", "persuratan");
                        $this->redirect("/admin/dashboard");
                    } else {
                        $this->Session->setFlash(__("Anda tidak mempunyai akses ke halaman ini."), 'default', array(), 'warninglogin');
                    }
                } else {
                    $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
                }
            } else {
                $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_persuratan";
        $this->set("title", "Login Sistem Informasi Manajemen Arsip Surat");
    }

    function login_persuratan_lupa_password() {
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("contain" => array("PasswordReset", "User", "Biodata"), "conditions" => array("OR" => array("User.email" => $this->data['User']['email']))));
            if (!empty($data)) {
                $token = hash("sha256", uniqid(mt_rand(), true), false);

                $this->Account->data['Account']['id'] = $data['Account']['id'];
                $this->Account->data['PasswordReset']['id'] = $data['PasswordReset']['id'];
                $this->Account->data['PasswordReset']['token'] = $token;
                $this->Account->data['PasswordReset']['expire'] = date("Y-m-d H:i:s", time() + (24 * 3600));
                $this->Account->data['PasswordReset']['is_used'] = false;
                $this->Account->saveAll();
                $this->_sentEmail("forgot-password", [
                    "tujuan" => $this->data['User']['email'],
                    "subject" => "SIDISPOP - Reset Password",
                    "from" => array("noreply@dispopsulbar.com" => "SIDISPOP"),
                    "acc" => "NoReply",
                    "item" => [
                        'token' => $token,
                        'username' => $data['User']['username'],
                    ],
                ]);
                $this->Session->setFlash(__("Silahkan mengecek email anda"), 'default', array(), 'successlupapassword');
                $this->redirect("/persuratan/lupa-password");
            } else {
                $this->Session->setFlash(__("Email tidak terdaftar"), 'default', array(), 'warninglupapassword');
                $this->redirect("/persuratan/lupa-password");
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_persuratan";
        $this->set("title", "Lupa Password");
    }

    function login_kepegawaian() {
        if (!empty($this->Session->read("credential.admin"))) {
            $this->redirect("/admin/dashboard");
        }
        $loginCredential = ClassRegistry::init("LoginPageCredential")->find("list", [
            "conditions" => [
                "LoginPage.name" => "kepegawaian",
                "LoginPageCredential.access" => true,
            ],
            "fields" => [
                "LoginPageCredential.user_group_id",
            ],
            "contain" => [
                "LoginPage",
            ]
        ]);
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("recursive" => 3, "conditions" => array("OR" => array("User.email" => $this->data['Account']['username'], "User.username" => $this->data['Account']['username']))));
            if (!empty($data)) {
                if ($this->_testPassword($this->data['Account']['password'], $data['User']['salt'], $data['User']['password'])) {
                    if (in_array($data['User']['user_group_id'], $loginCredential)) {
                        $this->Session->write("credential.admin", $data);
                        $this->Session->write("currentlogin", "kepegawaian");
                        $this->redirect("/admin/dashboard");
                    } else {
                        $this->Session->setFlash(__("Anda tidak mempunyai akses ke halaman ini."), 'default', array(), 'warninglogin');
                    }
                } else {
                    $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
                }
            } else {
                $this->Session->setFlash(__("Username atau password yang anda masukkan salah. Silahkan periksa kembali."), 'default', array(), 'warninglogin');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_kepegawaian";
        $this->set("title", "Login Sistem Informasi Manajemen Kepegawaian dan Kinerja");
    }

    function login_kepegawaian_lupa_password() {
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("contain" => array("PasswordReset", "User", "Biodata"), "conditions" => array("OR" => array("User.email" => $this->data['User']['email']))));
            if (!empty($data)) {
                $token = hash("sha256", uniqid(mt_rand(), true), false);

                $this->Account->data['Account']['id'] = $data['Account']['id'];
                $this->Account->data['PasswordReset']['id'] = $data['PasswordReset']['id'];
                $this->Account->data['PasswordReset']['token'] = $token;
                $this->Account->data['PasswordReset']['expire'] = date("Y-m-d H:i:s", time() + (24 * 3600));
                $this->Account->data['PasswordReset']['is_used'] = false;
                $this->Account->saveAll();
                $this->_sentEmail("forgot-password", [
                    "tujuan" => $this->data['User']['email'],
                    "subject" => "SIDISPOP - Reset Password",
                    "from" => array("noreply@dispopsulbar.com" => "SIDISPOP"),
                    "acc" => "NoReply",
                    "item" => [
                        'token' => $token,
                        'username' => $data['User']['username'],
                    ],
                ]);
                $this->Session->setFlash(__("Silahkan mengecek email anda"), 'default', array(), 'successlupapassword');
                $this->redirect("/kepegawaian/lupa-password");
            } else {
                $this->Session->setFlash(__("Email tidak terdaftar"), 'default', array(), 'warninglupapassword');
                $this->redirect("/kepegawaian/lupa-password");
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login_kepegawaian";
        $this->set("title", "Lupa Password");
    }

    function logout_admin() {
        $this->Session->delete("credential.admin");
        $currentSystem = $this->Session->read("currentlogin");
        if ($currentSystem == "persuratan") {
            $this->redirect("/persuratan");
        } else if ($currentSystem == "kepegawaian") {
            $this->redirect("/kepegawaian");
        } else if (is_null($currentSystem) || $currentSystem == "im") {
            $this->redirect("/admin");
        }
    }

    function login_member() {
        $this->autoRender = false;
        if ($this->request->is("post")) {
            $code = 402;
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("recursive" => 2, "conditions" => array("OR" => array("User.email" => $this->request->data['username'], "User.username" => $this->request->data['username']), "User.user_group_id" => 2)));
            if (!empty($data)) {
                if ($this->_testPassword($this->request->data['password'], $data['User']['salt'], $data['User']['password'])) {
                    $this->Session->write("credential.member", $data);
                    $code = 201;
                }
            }
            echo json_encode($this->_generateStatusCode($code));
        }
    }

    function logout_member() {
        $this->Session->delete("credential.member");
        $this->Session->delete("cart");
        $this->Session->delete("compare");
        $this->Session->delete("pembelian-terakhir");
        $this->redirect("/");
    }

    function _hashPassword($plain) {
        $hashed = hash("sha512", $plain, false);
        return $hashed;
    }

    function _testPassword($password, $salt, $hashedPassword) {
        return $hashedPassword == $this->_hashPassword($password . $salt);
    }

    function admin_change_password() {
        if ($this->request->is("post")) {
            if ($this->_testPassword($this->data['Account']['password_lama'], $this->Session->read("credential.admin.User.salt"), $this->Session->read("credential.admin.User.password"))) {
                $this->{ Inflector::classify($this->name) }->data = $this->data;
                unset($this->{ Inflector::classify($this->name) }->data['Account']['password_lama']);
                $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
                $salt = hash("sha224", uniqid(mt_rand(), true), false);
                $encrypt = $this->_hashPassword($password . $salt);
                if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                    $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                    $this->{ Inflector::classify($this->name) }->data["User"]["salt"] = $salt;
                    unset($this->{ Inflector::classify($this->name) }->data["User"]["repeat_password"]);
                    $this->{ Inflector::classify($this->name) }->data['Account']['id'] = $this->Session->read("credential.admin.Account.id");
                    $this->{ Inflector::classify($this->name) }->data["User"]["id"] = $this->Session->read("credential.admin.User.id");
                    $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data);
                    $this->_update_admin_session();
                    $this->data = array();
                    $this->Session->setFlash(__("Password berhasil diganti"), 'default', array(), 'success');
                } else {
                    $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                    $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
                }
            } else {
                $this->Session->setFlash(__("Password lama salah"), 'default', array(), 'danger');
            }
        }
    }

    function _update_admin_session() {
        $data = $this->{ Inflector::classify($this->name) }->find("first", array("conditions" => array("Account.id" => $this->Session->read("credential.admin.Account.id"))));
        $this->Session->write("credential.admin", $data);
    }

    function admin_restriction() {
        
    }

    function admin_change_status() {
        $this->autoRender = false;
        if ($this->request->is("PUT")) {
            $this->Account->id = $this->request->data['id'];
            $this->Account->save(array("Account" => array("account_status_id" => $this->request->data['status'])));
            $data = $this->Account->find("first", array("conditions" => array("Account.id" => $this->request->data['id']), "recursive" => 1));
            echo json_encode($this->_generateStatusCode(207, null, array("status_label" => $data['AccountStatus']['name'])));
        } else {
            echo json_encode($this->_generateStatusCode(400));
        }
    }

    function admin_ganti_pp() {
        if ($this->request->is("PUT") || $this->request->is("POST")) {
            $this->Account->data['Account']['id'] = $this->Session->read("credential.admin.Account.id");
            $this->Account->data['User']['id'] = $this->Session->read("credential.admin.User.id");
            App::import("Vendor", "qqUploader");
            $allowedExt = array("jpg", "jpeg", "png");
            $size = 10 * 1024 * 1024;
            $uploader = new qqFileUploader($allowedExt, $size, $this->data['Account']['profile_picture']);
            $result = $uploader->handleUpload("img" . DS . "profile_photos" . DS);
            switch ($result['status']) {
                case 206:
                    $this->Account->data['User']['profile_picture'] = "/{$result['data']['folder']}{$result['data']['fileName']}";
                    break;
                default:
                    $this->Session->setFlash(__($result['message']), 'default', array(), 'danger');
                    $this->redirect("/admin/dashboard");
                    break;
            }
            $this->Account->saveAll();
            $this->_update_admin_session();
            $this->Session->setFlash(__("Foto telah diperbaharui"), 'default', array(), 'success');
            $this->redirect("/admin/dashboard");
        } else {
            $this->Session->setFlash(__("Internal Server Error"), 'default', array(), 'danger');
            $this->redirect("/admin/dashboard");
        }
    }

    function reset_password($token = null) {
        $data = $this->{ Inflector::classify($this->name) }->find("first", array("contain" => array("PasswordReset", "User", "Biodata"), "conditions" => array("OR" => array("PasswordReset.token" => $token))));
        $now = new DateTime();
        if (is_null($token) || empty($data) || $data['PasswordReset']['is_used'] || $now > new DateTime($data['PasswordReset']['expire'])) {
            $this->redirect("/");
        }
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
                $salt = $data['User']['salt'];
                $encrypt = $this->_hashPassword($password . $salt);
                $this->{ Inflector::classify($this->name) }->data["Account"]["id"] = $data['Account']['id'];
                $this->{ Inflector::classify($this->name) }->data["User"]["id"] = $data['User']['id'];
                $this->{ Inflector::classify($this->name) }->data["PasswordReset"]["id"] = $data['PasswordReset']['id'];
                $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                $this->{ Inflector::classify($this->name) }->data["PasswordReset"]["is_used"] = true;
                unset($this->{ Inflector::classify($this->name) }->data["User"]["repeat_password"]);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array("deep" => true));
                $this->Session->setFlash(__("Kata sandi berhasil diubah"), 'default', array(), 'successlogin');
                $this->redirect("/");
            } else {
                $this->Session->setFlash(__("Periksa kesalahan"), 'default', array(), 'warninglogin');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login";
    }

}
