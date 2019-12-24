<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campus */

$this->title = 'Create Campus';
$this->params['breadcrumbs'][] = ['label' => 'Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campus-create">

    <h3> <i class="fa fa-building"><?= Html::encode($this->title) ?></i> </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
