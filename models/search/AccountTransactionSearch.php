<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountTransaction;

/**
 * AccountTransactionSearch represents the model behind the search form of `app\models\AccountTransaction`.
 */
class AccountTransactionSearch extends AccountTransaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ledger_no', 'account_no'], 'integer'],
            [['xact_type_code_de', 'xact_type_code_ext', 'date_created'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AccountTransaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ledger_no' => $this->ledger_no,
            'account_no' => $this->account_no,
            'amount' => $this->amount,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'xact_type_code_de', $this->xact_type_code_de])
            ->andFilterWhere(['like', 'xact_type_code_ext', $this->xact_type_code_ext]);

        return $dataProvider;
    }

    public function searchAccountMember($params, $id)
    {
        $query = AccountTransaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date_created' => SORT_DESC,
                ],
              ],
        ]);

    
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ledger_no' => $this->ledger_no,
            'account_no' => $id,
            'amount' => $this->amount,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'xact_type_code_de', $this->xact_type_code_de])
            ->andFilterWhere(['like', 'xact_type_code_ext', $this->xact_type_code_ext]);

        return $dataProvider;
    }
}
