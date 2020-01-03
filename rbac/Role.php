<?php

namespace app\rbac;

use app\models\User;
use yii\db\ActiveRecord;
use Yii;

class Role extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    public function rules()
    {
        return [
            [['item_name'], 'required'],
            [['item_name'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Access Right'),
        ];
    }


    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }
}
