<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'empno', 'campus_id', 'school_college_id', 'department_division_id', 'contact_number', 'classification_id', 'job_type_id', 'created_at', 'updated_at'], 'integer'],
            [['last_name', 'first_name', 'mi', 'birth_date', 'address', 'gravatar_id'], 'safe'],
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
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'empno' => $this->empno,
            'birth_date' => $this->birth_date,
            'campus_id' => $this->campus_id,
            'school_college_id' => $this->school_college_id,
            'department_division_id' => $this->department_division_id,
            'contact_number' => $this->contact_number,
            'classification_id' => $this->classification_id,
            'job_type_id' => $this->job_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'mi', $this->mi])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id]);

        return $dataProvider;
    }
}
