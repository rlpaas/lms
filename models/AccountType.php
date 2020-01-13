<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_type".
 *
 * @property int $id
 * @property string $account_name
 * @property int $xact_type_code_de
 * @property int $is_active
 *
 * @property Account[] $accounts
 * @property TransactionTypeDe $xactTypeCodeDe
 */
class AccountType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const IS_ACTIVE_YES = 1;
    const IS_ACTIVE_NO = 2;
    
    public static function tableName()
    {
        return 'account_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_name', 'xact_type_code_de', 'is_active'], 'required'],
            [['xact_type_code_de', 'is_active'], 'integer'],
            [['account_name'], 'string', 'max' => 150],
            [['xact_type_code_de'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionTypeDe::className(), 'targetAttribute' => ['xact_type_code_de' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_name' => 'Account Name',
            'xact_type_code_de' => 'Xact Type Code De',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['account_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXactTypeCodeDe()
    {
        return $this->hasOne(TransactionTypeDe::className(), ['id' => 'xact_type_code_de']);
    }
}
