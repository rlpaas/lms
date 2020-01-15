<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

use app\models\AccountTransaction;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->user->empno;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

    <div class="box-header" align="center">
        <h1><?= Html::encode($model->accountType->account_name) ?></h1>
     </div>
        <p>
            <?= Html::a('Add Transaction', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            
        </p>
   

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <h4 align="center"><b><?= Html::encode($model->user->empno.' '.$model->user->last_name.' '.$model->user->first_name) ?></b></h4>
                <?php if($model->account_type_id == 1): ?>
                    <div class="small-box bg-green">
                <?php elseif($model->account_type_id == 2): ?>
                    <div class="small-box bg-yellow">
                <?php  else: ?>
                    <div class="small-box bg-aqua">
                <?php endif; ?>
                        <div class="inner">
                          <h3><?= AccountTransaction::getSumExternalAccount($model->id); ?></h3>

                          <p><?= $model->accountType->account_name." "."(Balance)" ?></p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-money"></i>
                        </div>
                    </div>
            </div>
          </div>
          <!-- About Me Box -->
          <div class="box box-primary">
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Transactions History</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                    <?= GridView::widget([
                        'dataProvider' => $dataTransaction,
                        //'filterModel' => $searchTransaction,
                        'summary' => '',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            //'ledger_no',
                            //'account_no',
                            //'xact_type_code_de',
                            'date_created',
                            'xact_type_code_ext',
                            'amount',
                            

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->