<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolCollege */

$this->title = 'Update School/College: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'School Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="school-college-update">

    <h1><?= Html::encode($this->title) ?></h1>

   	<div class="school-college-form">

    <?php $form = ActiveForm::begin(['id'=>'scFrm']); ?>

    <?= $form->field($model, 'school_college_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'scBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
