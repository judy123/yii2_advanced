<?php

namespace info\models;

use Yii;

/**
 * This is the model class for table "info_content".
 *
 * @property string $id
 * @property string $name
 * @property string $content
 * @property integer $pid
 * @property integer $orderid
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
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
            'content' => 'Content',
            'pid' => 'Pid',
            'orderid' => 'Orderid',
        ];
    }
    
    public function getContentDatas($pid)
    {
        $db = Yii::$app->getDb();
        $content = (new \yii\db\Query())
        ->select(['name','pid','id','orderid'])
        ->from('info_content')
        ->where(['pid'=>$pid])
        ->orderBy('orderid ASC')
        ->all();
        return $content;
    }
}
