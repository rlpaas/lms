<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentDivision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-division-form">

    <?php $form = ActiveForm::begin(['id' => 'ddFrm']); ?>

    <?= $form->field($model, 'department_division_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->dropDownList($model->getIsActiveList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'ddBtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = Url::to(['department-division/create']);
$script = <<< JS

$("#ddBtn").click(function(e){
    var formData = new FormData($("#ddFrm")[0]);

    $.ajax({
        url: "$url",
        type: "POST",
        data: formData,
        success: function(response) {
            if(response == 1)
            {
                $('#ddFrm').trigger('reset');
                $.pjax.reload({container:'#ddTbl', async: false});
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
