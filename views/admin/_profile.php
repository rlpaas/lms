<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\DepartmentDivision;
use app\models\SchoolCollege;
use app\models\Campus;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Profile $profile
 */
?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

    <?= $form->field($profile, 'empno') ?>
    <?= $form->field($profile, 'last_name') ?>
    <?= $form->field($profile, 'first_name') ?>
    <?= $form->field($profile, 'mi') ?>
    <?= $form->field($profile, 'birth_date') ?>
    <?= $form->field($profile, 'address')->textarea() ?>
    <?= $form->field($profile, 'campus_id')->dropDownList(ArrayHelper::map(Campus::find()->where(['is_active'=>Campus::IS_ACTIVE_YES])->all(), 'id', 'campus_name'),[
        'prompt'=>'Select Campus', 'class'=>'form-control']) ?>
    <?= $form->field($profile, 'school_college_id')->dropDownList(ArrayHelper::map(SchoolCollege::find()->where(['is_active'=>SchoolCollege::IS_ACTIVE_YES])->all(), 'id', 'school_college_name'),[
        'prompt'=>'Select School/College', 'class'=>'form-control']) ?>
    <?= $form->field($profile, 'department_division_id')->dropDownList(ArrayHelper::map(DepartmentDivision::find()->where(['is_active'=>DepartmentDivision::IS_ACTIVE_YES])->all(), 'id', 'department_division_name'),[
        'prompt'=>'Select Department/Division', 'class'=>'form-control']) ?>
    <?= $form->field($profile, 'contact_number') ?>
    <?= $form->field($profile, 'classification_id') ?>
    <?= $form->field($profile, 'job_type_id') ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
