<?php

App::uses('File', 'Utility');
/*
 * Model Behavior
 * purpose  : delete file when tuple deleted
 * written  : Surya Wono(suryawono@yahoo.co.id)
 */

class DeleteableFileBehavior extends ModelBehavior {

    protected $deleteableFileFields = array();
    protected $data = array();
    protected $pathToUnlinks = array();

    public function setup(Model $Model, $config = array()) {
        $this->deleteableFileFields = $config['deleteableFileFields'];
    }

    function beforeDelete(\Model $model, $cascade = true) {
        parent::beforeDelete($model, $cascade);
        $this->data = $model->findById($model->id);
    }

    function afterDelete(\Model $model) {
        parent::afterDelete($model);
        foreach ($this->deleteableFileFields as $deleteableFileField) {
            $file = new File(WWW_ROOT . $this->data[$model->name][$deleteableFileField], false, 0777);
            $file->delete();
        }
    }

    function beforeSave(\Model $model, $options = array()) {
        parent::beforeSave($model, $options);
        $data = $model->findById($model->id);
        foreach ($this->deleteableFileFields as $deleteableFileField) {
            if (isset($data[$model->name][$deleteableFileField])){
            $toUnlink = $data[$model->name][$deleteableFileField];
            if ($model->data[$model->name][$deleteableFileField] != $toUnlink) {
                $this->pathToUnlinks[] = $toUnlink;
            }
            }
        }
    }

    function afterSave(\Model $model, $created, $options = array()) {
        parent::afterSave($model, $created, $options);
        foreach ($this->pathToUnlinks as $pathToUnlink) {
            $file = new File(WWW_ROOT . $pathToUnlink, false, 0777);
            $file->delete();
        }
    }

}
