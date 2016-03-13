<?php

namespace info\models;

use Yii;
use info\models\Content;

/**
 * This is the model class for table "info_classify".
 *
 * @property string $id
 * @property string $name
 * @property integer $pid
 * @property integer $orderid
 */
class Classify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_classify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['pid', 'orderid'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pid' => 'Pid',
            'orderid' => 'Orderid',
        ];
    }
    
    public function fields()
    {
        $fields = parent::fields();
    
        /* $fields['code'] = function ($model) {
            return (new District())->getCodeById($model->district_id);
        }; */
    
        //unset($fields['created_by'],$fields['updated_by'],$fields['created_at'],$fields['updated_at']);
    
        return $fields;
    }
    
    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields[] = 'contents';
        return $extraFields;
    }
    
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['pid' => 'id'])->select(['id','name']);
    }
    
    //pid下是否有子集
    public function hasDatas($pid)
    {
        $classify = (new \yii\db\Query())
        ->from('classify')
        ->where(['pid'=>$pid])
        ->all();
        if (!empty($classify)) {
            return true;
        } else {
            return false;   
        }
    }
    
    //{id:1, pId:0, name:"[core] 基本功能 演示", open:true},
    //{id:101, pId:1, name:"最简单的树 --  标准 JSON 数据", file:"core/standardData"},
    
    public function getClassifyDatas($pid=0, $datas=[])
    {
        $db = Yii::$app->getDb();
        $classify = (new \yii\db\Query())
        ->from('info_classify')
        ->where(['pid'=>$pid])
        ->orderBy('orderid ASC')
        ->all();
        foreach ($classify as $v) {
            $datas[] = ["id"=>$v['id'],
                        "pId"=>$v['pid'],
                        "name"=>$v['name'],
                        "open"=>false,
                        "children"=>array_merge($this->getClassifyDatas($v['id'], []),$this->getContentDatas($v['id'])),
            ];
            //$datas = $this->getContentDatas($v['id'],$datas);
            //$datas = $this->getCliassifyDatas($v['id'], $datas);
        }
        return $datas;
    }
    
    public function getContentDatas($pid)
    {
        $datas = array();
        $content = (new \yii\db\Query())
        ->select(['id','pid','name'])
        ->from('info_content')
        ->where(['pid'=>$pid])
        ->orderBy('orderid ASC')
        ->all();
        foreach ($content as $v) {
            $datas[] = ["id"=>$v['id'],
                        "pId"=>$v['pid'],
                        "name"=>$v['name'],
                        "file"=>$v['id'],
            ];
        }
        return $datas;
    }
    //========================联动======================//
    public function getClassifyLinkage($pid = 0)
    {
        $db = Yii::$app->getDb();
        $classify = (new \yii\db\Query())
        ->from('info_classify')
        ->where(['pid'=>$pid])
        ->orderBy('orderid ASC')
        ->all();
        return $classify;
    }
}
