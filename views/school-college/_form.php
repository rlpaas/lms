<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolCollege */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-college-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_college_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
