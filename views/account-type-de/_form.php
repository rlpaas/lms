<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionTypeDe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-type-de-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'xact_type_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
