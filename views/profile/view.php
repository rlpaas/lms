<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->last_name. ", ".$model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'user_id',
            'empno',
            'last_name',
            'first_name',
            'mi',
            'birth_date',
            'address:ntext',
            [
                'attribute' => 'campus_id',
                'value' => function ($model) { 
                    return !empty ($model->campus->campus_name) ? $model->campus->campus_name : '-';
                },
            ],
            [
                'attribute' => 'school_college_id',
                'value' => function ($model) { 
                    return !empty ($model->schoolCollege->school_college_name) ? $model->schoolCollege->school_college_name : '-';
                },
            ],
            [
                'attribute' => 'department_division_id',
                'value' => function ($model) { 
                    return  !empty ($model->departmentDivision->department_division_name) ? $model->departmentDivision->department_division_name : '-';
                },
            ],
            'contact_number',
            [
                'attribute' => 'classification_id',
                'value' => function ($model) { 
                    return $model->getClassificationName();
                },
            ],
            [
                'attribute' => 'job_type_id',
                'value' => function ($model) { 
                    return $model->getTypeName();
                },
            ],
            //'gravatar_id',
            [
                'attribute' => 'created_at',
                'value' => function ($model) { 
                    return Yii::$app->formatter->asDatetime($model->created_at);
                },
                'visible'=> Yii::$app->user->can('admin-permission'),
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) { 
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                },
                'visible'=> Yii::$app->user->can('admin-permission'),
            ],
        ],
    ]) ?>

</div>
