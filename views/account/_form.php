<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\EntityType;
use app\models\AccountType;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(['id' => 'account','enableAjaxValidation' => true,'validationUrl' => Yii::$app->urlManager->createUrl(['account/account-validate','id'=>$id])]); ?>

    <?= $form->field($model, 'entity_type_id')->dropDownList(ArrayHelper::map(EntityType::find()->where(['is_active'=>EntityType::IS_ACTIVE_YES])->all(), 'id', 'entity_name'),['prompt'=>'Select Entity Type', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'account_type_id')->dropDownList(ArrayHelper::map(AccountType::find()->where(['is_active'=>AccountType::IS_ACTIVE_YES])->all(), 'id', 'account_name'),['prompt'=>'Select Account Type', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'accountBtn']) ?>
        <?php // Html::a( 'Cancel', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = Url::to(['account/create', 'id'=>$id]);
$script = <<< JS

$("#accountBtn").click(function(e){
    var formData = new FormData($("#account")[0]);

    $.ajax({
        url: "$url",
        type: "POST",
        data: formData,
        success: function(response) {
            if(response == 1)
            {
                $('#account').trigger('reset');
                $.pjax.reload({container:'#accountTbl', async: false});
            }
        },

        error: function(){
            alert("ERROR at PHP side!!");
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});


JS;
$this->registerJs($script);
