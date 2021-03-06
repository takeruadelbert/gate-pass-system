<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
//Router::connect('/', array('front' => true, 'controller' => 'fronts', 'action' => 'display', 'ID', 'index'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

//=======================================================================================================
//front end
//pqp
Router::connect('/index', array('front' => true, 'controller' => 'fronts', 'action' => 'display', 'ID', 'index'));
Router::connect('/about-us', array('front' => true, 'controller' => 'fronts', 'action' => 'display', 'ID', 'aboutus'));

//member-area
Router::connect('/profil', array('member' => true, 'prefix' => 'front', 'controller' => 'fronts', 'action' => 'display', 'ID', 'profil'));
Router::connect('/member/logout', array('controller' => 'accounts', 'action' => 'logout_member'));

//Router::connect('/:lang/:page', array('front' => true, 'controller' => 'fronts', 'action' => 'display'), array("pass" => array('lang', 'page'), "lang" => "[A-Z]{2}"));
//=======================================================================================================
//admin area
Router::connect('/admin/change-password', array('admin' => true, 'controller' => 'accounts', 'action' => 'change_password'));
Router::connect('/admin', array('controller' => 'accounts', 'action' => 'login_admin'));
Router::connect('/', array('controller' => 'accounts', 'action' => 'login_admin'));
Router::connect('/admin/lupa-password', array('controller' => 'accounts', 'action' => 'login_utama_lupa_password'));
Router::connect('/admin/dashboard', array('admin' => true, 'controller' => 'accounts', 'action' => 'dashboard'));
Router::connect('/admin/logout', array('controller' => 'accounts', 'action' => 'logout_admin'));
Router::connect('/forgot-password', array('controller' => 'accounts', 'action' => 'forgot_password'));
Router::connect('/reset-password/*', array('controller' => 'accounts', 'action' => 'reset_password'));

//index
Router::connect('/module/*', array('admin' => true, 'controller' => 'modules', 'action' => 'index'));
Router::connect('/module-content/*', array('admin' => true, 'controller' => 'module_contents', 'action' => 'index'));
Router::connect('/account/*', array('admin' => true, 'controller' => 'accounts', 'action' => 'index'));

//add
Router::connect('/module-add', array('admin' => true, 'controller' => 'modules', 'action' => 'add'));
Router::connect('/module-content-add', array('admin' => true, 'controller' => 'module_contents', 'action' => 'add'));
Router::connect('/account-add', array('admin' => true, 'controller' => 'accounts', 'action' => 'add'));

//edit
Router::connect('/module-edit/*', array('admin' => true, 'controller' => 'modules', 'action' => 'edit'));
Router::connect('/module-content-edit/*', array('admin' => true, 'controller' => 'module_contents', 'action' => 'edit'));
Router::connect('/account-edit/*', array('admin' => true, 'controller' => 'accounts', 'action' => 'edit'));

//Report
Router::connect("/admin/restriction", array("admin" => true, "controller" => "accounts", "action" => "restriction"));

//Setting
Router::connect('/setting', array('admin' => true, 'controller' => 'company_profiles', 'action' => 'edit', '1'));
Router::connect("/system-config", array("admin" => true, 'controller' => 'entity_configurations', 'action' => 'edit'));
Router::connect("/change-logo", array("admin" => true, 'controller' => 'entity_configurations', 'action' => 'change_logo'));
Router::connect("/change-background-login", array("admin" => true, 'controller' => 'entity_configurations', 'action' => 'change_background_login'));

// Master Data
Router::connect("/setup-gate", array("admin" => true, 'controller' => 'gates', 'action' => 'index'));
Router::connect("/add-gate", array("admin" => true, 'controller' => 'gates', 'action' => 'add'));
Router::connect("/edit-gate", array("admin" => true, 'controller' => 'gates', 'action' => 'edit'));

Router::connect("/client", array("admin" => true, 'controller' => 'clients', 'action' => 'index'));
Router::connect("/add-client", array("admin" => true, 'controller' => 'clients', 'action' => 'add'));
Router::connect("/edit-client", array("admin" => true, 'controller' => 'clients', 'action' => 'edit'));

// Member Registration
Router::connect("/register", array("admin" => true, 'controller' => 'members', 'action' => 'index'));
Router::connect("/add-member", array("admin" => true, 'controller' => 'members', 'action' => 'add'));
Router::connect("/add-multiple-member", array('admin' => true, 'controller' => 'members', 'action' => 'multi_add'));
Router::connect("/blacklist-card-member", array('admin'=> true, 'controller' => 'members', 'action' => 'blacklist_card_member'));
Router::connect("/blacklist-member", array('admin'=> true, 'controller' => 'members', 'action' => 'blacklist_member'));
Router::connect("/whitelist-card-member", array('admin'=> true, 'controller' => 'members', 'action' => 'whitelist_card_member'));
Router::connect("/whitelist-member", array('admin'=> true, 'controller' => 'members', 'action' => 'whitelist_member'));

// Read History
Router::connect("/read-history-device", array('admin' => true, 'controller' => 'histories', 'action' => 'read_data_history'));
Router::connect("/history", array("admin" => true, 'controller' => 'histories', 'action_index'));

// Sync Data Member
Router::connect("/sync-data-member", array("admin" => true, 'controller' => 'members', 'action' => 'sync_data_member'));
Router::connect("/data-sync", array("admin" => true, "controller" => 'data_syncs', 'action' => 'index'));

// API
Router::connect("/api/access", array("api" => true, 'controller' => "members", 'action' => 'check_validity'));
Router::connect("/cron/auto-fetch-history", array("api" => true, "controller" => "histories", "action" => "auto_fetch_history"));
Router::connect("/cron/auto-sync-member", array("api" => true, "controller" => "data_syncs", "action" => "sync"));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
