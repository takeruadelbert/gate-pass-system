<?php

App::uses('AppController', 'Controller');

class SubMenusController extends AppController {

    var $name = "SubMenus";
    var $disabledAction=array(
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
    
    function _options(){
        $this->set("modules",$this->SubMenu->Module->find("list",["fields"=>["Module.id","Module.name"],"order"=>"Module.name"]));
        $this->set("menus",$this->SubMenu->Menu->find("list",["fields"=>["Menu.id","Menu.label"],"order"=>"Menu.label"]));
        $this->set("parents",$this->SubMenu->find("list",["fields"=>["SubMenu.id","SubMenu.label","Menu.label"],"order"=>"Menu.label","contain"=>["Menu"]]));
    }
    
    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->contain=[
            "Menu",
            "Module",
            "Parent",
        ];
        parent::admin_index();
    }
    
    function admin_list_by_menu($menu_id=null){
        $this->autoRender=false;
        $result=$this->SubMenu->find("list",[
            "conditions"=>[
                "SubMenu.menu_id"=>$menu_id,
            ],
            "fields"=>[
                "SubMenu.id",
                "SubMenu.label",
            ]
        ]);
        echo json_encode($this->_generateStatusCode(205,null,$result));
    }
}
