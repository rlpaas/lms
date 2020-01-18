<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CampusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campus-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
          <?= Html::button('Create', ['value'=>Url::to(['campus/create']),'class' => 'btn btn-success', 'id'=>'campusId']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id' => 'campusTbl','enablePushState' => false]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'campus_name',

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
                                    'id' => 'update-campus-' . $model->id,
                                    'data-toggle' => 'modal',
                                    'data-target' => '#campus-modals',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                                    'onclick' => "ajaxmodal('#campus-modal', '" . Url::to(['campus/update','id'=>$model->id]) . "')"
                                ]
                        );

             

                    },
                    /*'delete' => function ($url,$model) {

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'onclick' => "
                                if (confirm('are you sure, you want to delete?')) {
                                    $.ajax('".Url::to(['campus/delete','id'=>$model->id]) . "', {
                                        type: 'POST'
                                    }).done(function(data) {
                                       
                                        $.pjax.reload({container: '#campusTbl',async: false});
                                    });
                                }
                                return false;
                            ",
                        ]);

                    },*/
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end() ?>


</div>

<?php
Modal::begin([
    'id'=>'util',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentUtil'></div>";
Modal::end();

Modal::begin([
    'id' => 'campus-modal',
    //'header' => '<h4 class="modal-title">Update</h4>',
    'size'=>'modal-xs',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]); 
Modal::end();

?>
