<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

use app\models\EntityType;
use app\models\AccountType;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts'.'#:'.$id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($profile->empno.' '.$profile->last_name.' '.$profile->first_name) ?></h1>

   <p>
    <?= Html::button('Create', ['value'=>Url::to(['account/create', 'id'=>$id]),'class' => 'btn btn-success', 'id'=>'accountId']) ?>

    </p>

<?php Pjax::begin(['id' => 'accountTbl','enablePushState' => false]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=> '',
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

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
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
Modal::end()
?>
