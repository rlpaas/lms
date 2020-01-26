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
            [['account_name', 'chart_of_account_code', 'is_active'], 'required'],
            [['chart_of_account_code', 'is_active'], 'integer'],
            [['account_name'], 'string', 'max' => 150],
            [['chart_of_account_code'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['chart_of_account_code' => 'id']],
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
            'chart_of_account_code' => 'Chart Of Account Code',
            'is_active' => 'Is Active',
        ];
    }

    public function getIsActiveList()
    {
        $typeArray = [
            self::IS_ACTIVE_YES => 'Yes',
            self::IS_ACTIVE_NO => 'No',
        ];

        return $typeArray;

    }

    public function getIsActiveName($name = null)
    {
        $name = (empty($is_active)) ? $this->is_active : $is_active;

        if($name === self::IS_ACTIVE_YES)
        {
            return 'Yes';
        }else{

            return 'No';
        }
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
    public function getChartOfAccountCode()
    {
        return $this->hasOne(ChartOfAccount::className(), ['id' => 'chart_of_account_code']);
    }
}
