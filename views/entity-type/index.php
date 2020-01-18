<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EntityTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entity Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create', ['value'=>Url::to(['entity-type/create']),'class' => 'btn btn-success', 'id'=>'entityId']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id' => 'entityTbl','enablePushState' => false]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'entity_name',
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
                                    'onclick' => "ajaxmodal('#entity-modal', '" . Url::to(['entity-type/update','id'=>$model->id]) . "')"
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
    'id'=>'entityPop',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentEntity'></div>";
Modal::end();

Modal::begin([
    'id' => 'entity-modal',
    //'header' => '<h4 class="modal-title">Update</h4>',
    'size'=>'modal-xs',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]); 
Modal::end();
?>