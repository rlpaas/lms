<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TransactionTypeDe;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AccountType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-type-form">

    <?php $form = ActiveForm::begin(['id'=>'accountFrm']); ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xact_type_code_de')->dropDownList(ArrayHelper::map(TransactionTypeDe::find()->all(), 'id', 'name'),[
        'prompt'=>'Select Type', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'accountBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$url = Url::to(['account-type/create']);
$script = <<< JS

$("#accountBtn").click(function(e){
    var formData = new FormData($("#accountFrm")[0]);

    $.ajax({
        url: "$url",
        type: "POST",
        data: formData,
        success: function(response) {
            if(response == 1)
            {
                $('#accountFrm').trigger('reset');
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