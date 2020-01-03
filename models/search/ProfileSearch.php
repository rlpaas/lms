<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

use app\rbac\AuthItem;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public $campus;
    public $schoolCollege;
    public $department;

    
    public function rules()
    {
        return [
            [['user_id', 'empno', 'classification_id', 'job_type_id', 'created_at', 'updated_at'], 'integer'],
            [['last_name', 'first_name', 'mi', 'birth_date', 'address', 'gravatar_id','campus','schoolCollege','department','contact_number'], 'safe'],
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
    public function search($params,$theCreator=false)
    {
        $query = Profile::find()->joinWith(['campus','schoolCollege','departmentDivision','role']);

        // add conditions that should always apply here

        if ($theCreator === false) 
        {
            $query->where(['!=', 'item_name', 'theCreator']);
        }

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
            'contact_number' => $this->contact_number,
            'classification_id' => $this->classification_id,
            'job_type_id' => $this->job_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $dataProvider->sort->attributes['campus'] = [
            'asc' => ['campus.campus_name' => SORT_ASC],
            'desc' => ['campus.campus_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['schoolCollege'] = [
            'asc' => ['school_college.school_college_name' => SORT_ASC],
            'desc' => ['school_college.school_college_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['department'] = [
            'asc' => ['department_division.department_division_name' => SORT_ASC],
            'desc' => ['department_division.department_division_name' => SORT_DESC],
        ];


        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'mi', $this->mi])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id]);

        $query->andFilterWhere([
            'campus.id' => $this->campus,
            'school_college.id' => $this->schoolCollege,
            'department_division.id' => $this->department,

        ]);

        return $dataProvider;
    }

     public function searchAccount($params,$theCreator=false)
    {
        $query = Profile::find()->joinWith(['campus','schoolCollege','departmentDivision','role']);

        // add conditions that should always apply here

        if ($theCreator === false) 
        {
            $query->where(['!=', 'item_name', 'theCreator']);
        }

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
            'contact_number' => $this->contact_number,
            'classification_id' => $this->classification_id,
            'job_type_id' => $this->job_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $dataProvider->sort->attributes['campus'] = [
            'asc' => ['campus.campus_name' => SORT_ASC],
            'desc' => ['campus.campus_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['schoolCollege'] = [
            'asc' => ['school_college.school_college_name' => SORT_ASC],
            'desc' => ['school_college.school_college_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['department'] = [
            'asc' => ['department_division.department_division_name' => SORT_ASC],
            'desc' => ['department_division.department_division_name' => SORT_DESC],
        ];


        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'mi', $this->mi])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id]);

        $query->andFilterWhere([
            'campus.id' => $this->campus,
            'school_college.id' => $this->schoolCollege,
            'department_division.id' => $this->department,

        ]);

        return $dataProvider;
    }
}
