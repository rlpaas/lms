<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\TransactionTypeExt;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Ledger (SL)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total SL Transaction</span>
              <span class="info-box-number"><?= $searchModel->getTotalSl($account_ids,'totalSl') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Credit</span>
              <span class="info-box-number"><?= $searchModel->getTotalSl($account_ids,'credit') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Debit</span>
              <span class="info-box-number"><?= $searchModel->getTotalSl($account_ids,'debit') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total <?= $accountType->account_name ?></span>
              <span class="info-box-number"><?= $searchModel->getTotalSl($account_ids,'balance') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=> 'last_name',
                'pageSummary' => 'Total',
                'format'=> 'raw',
                'value' => function ($data) {
                    return $data->account->user->last_name;

                },

            ],
            [
                'attribute'=> 'first_name',
                'format'=> 'raw',
                'value' => function ($data) {
                    return $data->account->user->first_name;

                },

            ],
            [
                'attribute'=> 'xact_type_code_ext',
                'format'=> 'raw',
                'filter' =>ArrayHelper::map(TransactionTypeExt::find()->asArray()->all(), 'xact_type_code_ext', 'description'),
                'value' => function ($data) {
                    return $data->getTransactionAccountList($data->xact_type_code_ext);

                },

            ],

            [

            'attribute'=>'amount',
            'pageSummary' => true

            ],
            
            'date_created',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>''
            
            ],
        ],
    ]); ?>


</div>
