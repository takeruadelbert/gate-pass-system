<?php

class Account extends AppModel {
    public $validate = array(
        
    );
    
    public $belongsTo = array(
        'AccountStatus',
        'Employee',
        "PasswordReset",
    );
    
    public $hasOne = array(
        "User" => array(
            "dependent" => true
        ),
        "Biodata" => array(
            "dependent" => true
        ),
    );

}
