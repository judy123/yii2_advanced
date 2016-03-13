<?php

namespace info\controllers;

use Yii;
use yii\rest\ActiveController;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentRestController extends ActiveController
{
    public $modelClass = 'info\models\Content';
    
    public function actions()
    {
        $actions = parent::actions();
    
        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
    
        return $actions;
    }
    
    public function prepareDataProvider ()
    {
        $pid = isset($_GET['pid'])?$_GET['pid']:1;
        $modelClass = $this->modelClass;
        $model = new $modelClass;       
        return $model->getContentDatas($pid);
        
    
    }
}
