<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\EntityType */

$this->title = 'Update Entity Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entity-type-form">

    <?php $form = ActiveForm::begin(['id' => 'entityFrm']); ?>

    <?= $form->field($model, 'entity_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'entityBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>