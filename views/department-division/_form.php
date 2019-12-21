<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentDivision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-division-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_division_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
