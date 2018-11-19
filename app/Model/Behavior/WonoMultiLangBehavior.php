<?php
//deprecated
/*
 * Model Behavior
 * purpose  : saving multi language into single fields using json format
 * written  : Surya Wono(suryawono@yahoo.co.id)
 * standard : user ISO 639-2/5 as language code
 */

class WonoMultiLangBehavior extends ModelBehavior {

    public $defaultLang = "ind";
    public $lang = "ind";
    protected $langFields = array();
    public $langPack = array(
        0 => "need to translate",
    );
    public $raw = false;

    public function setup(Model $Model, $config = array()) {
        $this->lang = !empty(CakeSession::read("wonomultilang.lang")) ? CakeSession::read("wonomultilang.lang") : "eng";
        $this->langFields = $config;
    }

    function beforeSave(\Model $model, $options = array()) {
        parent::beforeSave($model, $options);
        $this->raw = true;
        if ($this->_valid($model)) {
            foreach ($model->data[$model->name] as $k => $v) {
                if (is_string($k) && isset($this->langFields[$model->name]) && in_array($k, $this->langFields[$model->name])) {
                    if ($model->id === false) {
                        $model->data[$model->name][$k] = json_encode(array(
                            $this->lang => $v,
                        ));
                    } else {
                        $data = $model->find("first", array("recursive" => -1, "fields" => array($k), "conditions" => array("id" => $model->id)));
                        $o = json_decode($data[$model->name][$k]);
                        if (is_null($o)) {
                            $model->data[$model->name][$k] = json_encode(array(
                                $this->lang => $v,
                            ));
                        } else {
                            $o = (array) $o;
                            $o[$this->lang] = $v;
                            $model->data[$model->name][$k] = json_encode($o);
                        }
                    }
                }
            }
        }
    }

    function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);
        if ($this->_valid($model)) {
            foreach ($results as $i => $result) {
                $results[$i] = $this->_detach($result);
            }
        }
        return $results;
    }

    function _detach($o = null, $name = null, $grandName = null) {
        foreach ($o as $k => $v) {
            if (is_array($v)) {
                $o[$k] = $this->_detach($v, $k, $name);
            } else {
                $needle = $name;
                if (is_int($name)) {
                    $needle = $grandName;
                }
                if (is_string($k) && isset($this->langFields[$needle]) && in_array($k, $this->langFields[$needle])) {
                    $decode = json_decode($v);
                    if (is_null($decode)) {
                        $o[$k] = $v . " [no-packed] [{$this->langPack[0]}]";
                    } else {
                        $decode_array = (array) $decode;
                        $l = key($decode);
                        $c = reset($decode);
                        if (isset($decode->{$this->lang})) {
                            $o[$k] = $decode->{$this->lang};
                        } else if (isset($decode->{$this->defaultLang})) {
                            $o[$k] = $decode->{$this->defaultLang} . " [$l] [{$this->langPack[0]}]";
                        } else if (empty($decode)) {
                            $o[$k] = "[need translate]";
                        } else {
                            $o[$k] = "$c [$l] [{$this->langPack[0]}]";
                        }
                    }
                }
            }
        }
        return $o;
    }

    function _valid($model) {
        return true;
    }

}
