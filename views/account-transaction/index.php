<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Account Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ledger_no',
            'xact_type_code_de',
            'xact_type_code_ext',
            'account_no',
            //'amount',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn',
            
            ],
        ],
    ]); ?>


</div>
