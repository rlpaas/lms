<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property int $user_id
 * @property int $entity_type_id
 * @property int $account_type_id
 * @property int $status
 *
 * @property Profile $user
 * @property AccountType $accountType
 * @property EntityType $entityType
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const IS_STATUS_ACTIVE = 1;
    const IS_STATUS_INACTIVE = 2;
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_type_id', 'account_type_id', 'status'], 'required'],
            [['user_id', 'entity_type_id', 'account_type_id', 'status'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['account_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountType::className(), 'targetAttribute' => ['account_type_id' => 'id']],
            [['entity_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EntityType::className(), 'targetAttribute' => ['entity_type_id' => 'id']],

            [['user_id', 'entity_type_id', 'account_type_id'], 'unique', 'targetAttribute' => ['user_id', 'entity_type_id', 'account_type_id'], 'message' => 'Entity Type and Account Type has already been added to this account'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'entity_type_id' => 'Entity Type',
            'account_type_id' => 'Account Type',
            'status' => 'Status',
        ];
    }

    public function getStatusList()
    {
        $typeArray = [
            self::IS_STATUS_ACTIVE => 'Active',
            self::IS_STATUS_INACTIVE => 'Inactive',
        ];

        return $typeArray;

    }

    public function getStatusName($name = null)
    {
        $name = (empty($status)) ? $this->status : $status;

        if($name === self::IS_STATUS_ACTIVE)
        {
            return 'Active';
        }else{

            return 'Inactive';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountType()
    {
        return $this->hasOne(AccountType::className(), ['id' => 'account_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityType()
    {
        return $this->hasOne(EntityType::className(), ['id' => 'entity_type_id']);
    }

    public function getAccountTransaction()
    {
        return $this->hasMany(AccountTransaction::className(), ['account_no' => 'id']);

    }

}
