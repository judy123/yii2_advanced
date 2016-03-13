<?php

namespace info\controllers;

use Yii;
use yii\rest\ActiveController;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ClassifyRestController extends ActiveController
{
    public $modelClass = 'info\models\classify';
    
    public function actions()
    {
        $actions = parent::actions();
    
        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
    
        return $actions;
    }
    
    public function prepareDataProvider ()
    {
        //$kwd = isset($_GET['keyword'])?$_GET['keyword']:"";
        //$type = isset($_GET['type'])?$_GET['type']:1;
        $pid = isset($_GET['pid'])?$_GET['pid']:0;
        $linkage = isset($_GET['linkage'])?true:false;
        
        $modelClass = $this->modelClass;
        $model = new $modelClass;
        if ($linkage) {
            return $model->getClassifyLinkage($pid);
        } else {
            return $model->getClassifyDatas();
        }
        
    }
}
