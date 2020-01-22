<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "account_transaction".
 *
 * @property int $id
 * @property int $ledger_no
 * @property string $xact_type_code_de
 * @property string $xact_type_code_ext
 * @property int $account_no
 * @property float $amount
 * @property string $date_created
 *
 * @property Account $accountNo
 */
class AccountTransaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xact_type_code_ext', 'account_no', 'amount'], 'required'],
            [['ledger_no', 'account_no'], 'integer'],
            [['amount'], 'number'],
            [['date_created'], 'safe'],
            [['xact_type_code_de', 'xact_type_code_ext'], 'string', 'max' => 2],
            [['account_no'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_no' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ledger_no' => 'Ledger No',
            'xact_type_code_de' => 'Debit/Credit',
            'xact_type_code_ext' => 'Transaction',
            'account_no' => 'Account Type',
            'amount' => 'Amount',
            'date_created' => 'Date-Time',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_created',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Gets query for [[AccountNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountNo()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_no']);
    }

    public static function getSumExternalAccount($id)
    {
        //for external account CREDIT when you want to increase the amount and DEBIT when you want to decrease
        $totalCredit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction WHERE account_no = $id AND xact_type_code_ext IN ( 'Dp','Dv','Pt' ) ");
        $sumCredit = $totalCredit->queryScalar();

        //not in, meaning not on the list, like widrawal
        $totalDebit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction WHERE account_no = $id AND xact_type_code_ext NOT IN ( 'Dp','Dv','Pt' ) ");
        $sumDebit = $totalDebit->queryScalar();

        $currentBalance = $sumCredit - $sumDebit;

        return number_format($currentBalance, 2);

    }

    public static function getTransactionAccountList($code)
    {
        $ext = TransactionTypeExt::find()->where(['xact_type_code_ext'=> $code])->one();
        return $ext->description;
        
    }

    public function getTransactionAccountProcess()
    {
        if($this->xact_type_code_ext == 'Dp' OR $this->xact_type_code_ext == 'Dv' OR $this->xact_type_code_ext == 'Pt')
        {
            $this->xact_type_code_de = 'Dr';

        }else{
            $this->xact_type_code_de = 'Cr';
        }
        
        $this->ledger_no = 9;

            
    }

    public function getCheckNegative($id,$amount)
    {

        //for external account CREDIT when you want to increase the amount and DEBIT when you want to decrease
        $totalCredit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction WHERE account_no = $id AND xact_type_code_ext IN ( 'Dp','Dv','Pt' ) ");
        $sumCredit = $totalCredit->queryScalar();

        //not in, meaning not on the list, like widrawal
        $totalDebit = Yii::$app->db->createCommand("SELECT sum(amount) FROM account_transaction WHERE account_no = $id AND xact_type_code_ext NOT IN ( 'Dp','Dv','Pt' ) ");
        $sumDebit = $totalDebit->queryScalar();

        $currentBalance = $sumCredit - $sumDebit;

        $total = $currentBalance - $amount;

        return number_format($total, 2);

    }


}
