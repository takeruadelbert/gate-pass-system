<?php

class Employee extends AppModel {

    public $validate = array(
    );
    public $belongsTo = array(
        "Department",
    );
    public $hasOne = array(
        "Account" => array(
            "dependent" => true
        ),
    );
    public $hasMany = array(
    );

    function getListWithFullname() {
        $data = $this->find("all", [
            "contain" => [
                "Account" => [
                    "Biodata",
                    "User",
                ],
            ],
        ]);
        $result = [];
        foreach ($data as $tuple) {
            if (in_array($tuple["Account"]["User"]["user_group_id"], ClassRegistry::init("UserGroup")->excludedUserGroup())) {
                continue;
            }
            $result[$tuple["Employee"]['id']] = $tuple['Account']['Biodata']['full_name'];
        }
        asort($result);
        return $result;
    }

    function excludedEmployee() {
        return ClassRegistry::init("Account")->find("list", [
                    "conditions" => [
                        "User.user_group_id" => ClassRegistry::init("UserGroup")->excludedUserGroup(),
                    ],
                    "contain" => [
                        "Employee",
                        "User",
                    ]
        ]);
    }

}
