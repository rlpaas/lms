<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolCollege */

$this->title = 'Create School/College';
$this->params['breadcrumbs'][] = ['label' => 'School Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-college-create">

     <h3> <i class="fa fa-building"><?= Html::encode($this->title) ?></i> </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
