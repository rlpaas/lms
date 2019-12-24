<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Campus */

$this->title = 'Update Campus: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="campus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="campus-form">

    <?php $form = ActiveForm::begin(['id' => 'campusFrm']); ?>

    <?= $form->field($model, 'campus_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'campusBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
