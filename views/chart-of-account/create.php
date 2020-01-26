<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChartOfAccount */

$this->title = 'Create Chart Of Account';
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chart-of-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
