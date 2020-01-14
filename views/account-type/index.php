<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\TransactionTypeDe;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccountTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create', ['value'=>Url::to(['account-type/create']),'class' => 'btn btn-success', 'id'=>'accountId']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id' => 'accountTbl','enablePushState' => false]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'account_name',
            //'xact_type_code_de',
            [
                'attribute'=> 'xact_type_code_de',
                'filter' =>ArrayHelper::map(TransactionTypeDe::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    return $data->xactTypeCodeDe->name;
                },
            ],
            [
                'attribute'=>'is_active',
                'filter'=>$searchModel->getIsActiveList(),
                'value'=>function ($data){
                    return $data->getIsActiveName();
                }
            
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=> '{update}{delete}',
                 'buttons' => [
                  'update' => function ($url, $model, $key) {

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,
                                [
                                    'title' => 'Update',
                                    'id' => 'update-dd-' . $model->id,
                                    'data-toggle' => 'modal',
                                    'data-target' => '#dd-modals',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                                    'onclick' => "ajaxmodal('#account-modal', '" . Url::to(['account-type/update','id'=>$model->id]) . "')"
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
    //'header' => '<h4 class="modal-title">Update</h4>',
    'size'=>'modal-xs',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]); 
Modal::end();
?>