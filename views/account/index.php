<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

use app\models\EntityType;
use app\models\AccountType;
use app\models\AccountTransaction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts'.'#:'.$id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($profile->empno.' '.$profile->last_name.' '.$profile->first_name) ?></h1>

   <p>
    <?= Html::button('<i class="fa fa-fw fa-user"></i> Account', ['value'=>Url::to(['account/create', 'id'=>$id]),'class' => 'btn btn-success', 'id'=>'accountId']) ?>
    <?= Html::button('<i class="fa fa-fw  fa-folder-open"></i> Transaction', ['value'=>Url::to(['account-transaction/create','id'=>$id]),'class' => 'btn btn-primary','id'=> 'transId']) ?>

    </p>

<?php Pjax::begin(['id' => 'accountTbl','enablePushState' => false]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=> '',
        'responsiveWrap' => false,
        'rowOptions'=>function($model){
            if($model->account_type_id == 1){
                return ['class' => 'info'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [
                'attribute'=> 'entity_type_id',
                'filter' =>ArrayHelper::map(EntityType::find()->asArray()->all(), 'id', 'entity_name'),
                'value' => function ($data) {
                    return $data->entityType->entity_name;
                },
            ],

            [
                'attribute'=> 'account_type_id',
                'filter' =>ArrayHelper::map(AccountType::find()->asArray()->all(), 'id', 'account_name'),
                'value' => function ($data) {
                    return $data->accountType->account_name;
                },
            ],

            [
                'attribute'=>'status',
                'filter'=>$searchModel->getStatusList(),
                'value'=>function ($data){
                    return $data->getStatusName();
                }
            
            ],
            [
                'attribute'=> 'Balance',
                'format'=> 'raw',
                'value' => function ($data) {
                    return AccountTransaction::getSumExternalAccount($data->id);

                },

            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                  'view' => function ($url, $model, $key) {

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#',
                                [
                                    'title' => 'Update',
                                    'id' => 'account-view'. $model->id,
                                    'data-toggle' => 'modal',
                                    'data-target' => '#account-modals',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                                    'onclick' => "ajaxmodal('#account-modal', '" . Url::to(['account/view','id'=>$model->id]) . "')"
                                ]
                        );

             

                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end() ?>

</div>
<?php
Modal::begin([
    'id'=>'accountPop',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentAccount'></div>";
Modal::end();

Modal::begin([
    'id' => 'account-modal',
    'size'=>'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',

]);
Modal::end();

Modal::begin([
    'id'=>'transPop',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentTrans'></div>";
Modal::end();
?>
