<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction_type_ext".
 *
 * @property int $id
 * @property string $xact_type_code_ext
 * @property string $description
 */
class TransactionTypeExt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction_type_ext';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xact_type_code_ext', 'description'], 'required'],
            [['xact_type_code_ext'], 'string', 'max' => 2],
            [['description'], 'string', 'max' => 155],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xact_type_code_ext' => 'Xact Type Code Ext',
            'description' => 'Description',
        ];
    }
}
