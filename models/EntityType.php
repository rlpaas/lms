<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entity_type".
 *
 * @property int $id
 * @property string $entity_name
 * @property int $is_active
 *
 * @property Account[] $accounts
 */
class EntityType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const IS_ACTIVE_YES = 1;
    const IS_ACTIVE_NO = 2;
    
    public static function tableName()
    {
        return 'entity_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['entity_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_name' => 'Entity Name',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['entity_type_id' => 'id']);
    }
}
