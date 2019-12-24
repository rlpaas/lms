<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentDivision */

$this->title = 'Update Department/Division: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Department Divisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-division-update">

    <h1><?= Html::encode($this->title) ?></h1>

 <?php $form = ActiveForm::begin(['id' => 'ddFrm']); ?>

    <?= $form->field($model, 'department_division_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'ddBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
