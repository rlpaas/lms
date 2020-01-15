<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ledger_no')->textInput() ?>

    <?= $form->field($model, 'xact_type_code_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xact_type_code_ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_no')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
