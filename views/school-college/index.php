<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolCollegeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'School/Colleges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-college-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create', ['value'=>Url::to(['school-college/create']),'class' => 'btn btn-success', 'id'=>'scId']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id' => 'scTbl','enablePushState' => false]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'school_college_name',
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
                                    'id' => 'update-sc-' . $model->id,
                                    'data-toggle' => 'modal',
                                    'data-target' => '#sc-modals',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                                    'onclick' => "ajaxmodal('#sc-modal', '" . Url::to(['school-college/update','id'=>$model->id]) . "')"
                                ]
                        );

             

                    },
                    /*'delete' => function ($url,$model) {

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'onclick' => "
                                if (confirm('are you sure, you want to delete?')) {
                                    $.ajax('".Url::to(['school-college/delete','id'=>$model->id]) . "', {
                                        type: 'POST'
                                    }).done(function(data) {
                                       
                                        $.pjax.reload({container: '#scTbl',async: false});
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
    'id'=>'scPop',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentSc'></div>";
Modal::end();

Modal::begin([
    'id' => 'sc-modal',
    //'header' => '<h4 class="modal-title">Update</h4>',
    'size'=>'modal-xs',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]); 
Modal::end();

?>
