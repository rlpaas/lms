<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction_type_de".
 *
 * @property int $id
 * @property string $xact_type_code
 * @property string $name
 *
 * @property AccountType[] $accountTypes
 */
class TransactionTypeDe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction_type_de';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xact_type_code', 'name'], 'required'],
            [['xact_type_code'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 155],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xact_type_code' => 'Xact Type Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTypes()
    {
        return $this->hasMany(AccountType::className(), ['xact_type_code_de' => 'id']);
    }
}
