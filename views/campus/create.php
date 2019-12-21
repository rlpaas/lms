<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campus */

$this->title = 'Create Campus';
$this->params['breadcrumbs'][] = ['label' => 'Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
