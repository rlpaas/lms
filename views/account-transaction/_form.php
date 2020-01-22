<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\Account;
use app\models\TransactionTypeExt;

/* @var $this yii\web\View */
/* @var $model app\models\AccountTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-transaction-form">

    <?php $form = ActiveForm::begin(['id' => 'transFrm']); ?>

    <?= $form->field($model, 'account_no')->dropDownList(ArrayHelper::map(Account::find()->where(['status'=>Account::IS_STATUS_ACTIVE, 'user_id'=>$id])->all(), 'id','accountType.account_name','entityType.entity_name'),['prompt'=>'Select Account', 'class'=>'form-control']) ?>


    <?= $form->field($model, 'xact_type_code_ext')->dropDownList(ArrayHelper::map(TransactionTypeExt::find()->all(), 'xact_type_code_ext', 'description'),['prompt'=>'Select Transaction', 'class'=>'form-control']) ?>


    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'transBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = Url::to(['account-transaction/create','id'=>$id]);
$script = <<< JS

$("#transBtn").click(function(e){
    var formData = new FormData($("#transFrm")[0]);

    $.ajax({
        url: "$url",
        type: "POST",
        data: formData,
        success: function(response) {
            if(response == 1)
            {
                $('#transFrm').trigger('reset');
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
