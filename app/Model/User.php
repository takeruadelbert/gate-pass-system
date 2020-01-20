<?php

class User extends AppModel {

    public $validate = array(
        'username' => array(
            'Harus diisi' => array("rule" => "NotBlank"),
            'Sudah terdaftar' => array("rule" => 'isUnique'),
            'Hanya alphanumeric' => array("rule" => 'alphaNumeric'),
        ),
        'password' => array(
            'rule1' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Minimal 6 karakter'
            ),
            'rule2' => array(
                'rule' => 'NotBlank',
                'message' => 'Hasur diisi'
            )
        ),
        'user_group_id' => array(
            'rule' => 'NotBlank',
            'message' => 'Hasur dipilih'
        ),
        'repeat_password' => array(
            'rule1' => array(
                'rule' => 'checkPassword',
                'message' => 'Kata sandi tidak sama'
            ),
            'rule2' => array(
                'rule' => 'NotBlank',
                'message' => 'Hasur diisi'
            )
        ),
        'email' => array(
            'Harus diisi' => array("rule" => 'NotBlank'),
            'Sudah terdaftar' => array("rule" => 'isUnique'),
        )
    );
    public $belongsTo = array(
        'UserGroup',
        "Account",
    );
    public $hasOne = array(
        
    );

    function checkPassword() {
        if ($this->data['User']['password'] != $this->data['User']['repeat_password']) {
            return false;
        }
        return true;
    }

}
