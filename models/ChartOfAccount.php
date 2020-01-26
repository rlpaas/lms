<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chart_of_account".
 *
 * @property int $id
 * @property string $name
 * @property string $classification
 */
class ChartOfAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chart_of_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'classification'], 'required'],
            [['name', 'classification'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'classification' => 'Classification',
        ];
    }

    public static function getSumChartOfAccount($id)
    {
        //for external account CREDIT when you want to increase the amount and DEBIT when you want to decrease
        $totalCredit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction JOIN account ON account_transaction.account_no = account.id JOIN account_type ON account.account_type_id = account_type.id WHERE chart_of_account_code = $id AND xact_type_code_ext IN ( 'Dp','Dv','Pt' ) ");
        $sumCredit = $totalCredit->queryScalar();

        //not in, meaning not on the list, like widrawal
        $totalDebit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction JOIN account ON account_transaction.account_no = account.id JOIN account_type ON account.account_type_id = account_type.id WHERE chart_of_account_code = $id AND xact_type_code_ext NOT IN ( 'Dp','Dv','Pt' ) ");
        $sumDebit = $totalDebit->queryScalar();

        $currentBalance = $sumCredit - $sumDebit;

        return number_format($currentBalance, 2);

    }
    
}
