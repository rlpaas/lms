<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Campus;
use app\models\SchoolCollege;
use app\models\DepartmentDivision;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            //'user_id',
            'empno',
            'last_name',
            'first_name',
            //'mi',
            //'birth_date',
            //'address:ntext',
            [
                'attribute'=> 'campus',
                'filter' =>ArrayHelper::map(Campus::find()->asArray()->all(), 'id', 'campus_name'),
                'value' => function ($data) {
                    return !empty ($data->campus->campus_name) ? $data->campus->campus_name : '-';
                },
            ],
            [
                'attribute'=> 'schoolCollege',
                'label'=> 'School/College',
                'filter' =>ArrayHelper::map(SchoolCollege::find()->asArray()->all(), 'id', 'school_college_name'),
                'value' => function ($data) {
                    return !empty ($data->schoolCollege->school_college_name) ? $data->schoolCollege->school_college_name : '-';
                },
            ],

            [
                'attribute'=> 'department',
                'label'=> 'Department/Division',
                'filter' =>ArrayHelper::map(DepartmentDivision::find()->asArray()->all(), 'id', 'department_division_name'),
                'value' => function ($data) {
                    return  !empty ($data->departmentDivision->department_division_name) ? $data->departmentDivision->department_division_name : '-';
                },
            ],
            //'contact_number',
            //'classification_id',
  
            [
                'attribute'=>'job_type_id',
                'filter'=>$searchModel->getTypeList(),
                'value'=>function ($data){
                    return $data->getTypeName();
                }
            
            ],
            //'gravatar_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>


</div>
