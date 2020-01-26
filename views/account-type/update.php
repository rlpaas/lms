<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ChartOfAccount;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AccountType */

$this->title = 'Update Account Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="account-type-form">

    <?php $form = ActiveForm::begin(['id'=>'accountFrm']); ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chart_of_account_code')->dropDownList(ArrayHelper::map(ChartOfAccount::find()->all(), 'id', 'name'),[
        'prompt'=>'Select Type', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'accountBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>