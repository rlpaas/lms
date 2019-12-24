<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentDivisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Department/Divisions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-division-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create', ['value'=>Url::to(['department-division/create']),'class' => 'btn btn-success', 'id'=>'ddId']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(['id' => 'ddTbl','enablePushState' => false]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'department_division_name',
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
                                    'onclick' => "ajaxmodal('#dd-modal', '" . Url::to(['department-division/update','id'=>$model->id]) . "')"
                                ]
                        );

             

                    },
                    'delete' => function ($url,$model) {

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'onclick' => "
                                if (confirm('are you sure, you want to delete?')) {
                                    $.ajax('".Url::to(['department-division/delete','id'=>$model->id]) . "', {
                                        type: 'POST'
                                    }).done(function(data) {
                                       
                                        $.pjax.reload({container: '#ddTbl',async: false});
                                    });
                                }
                                return false;
                            ",
                        ]);

                   

                    },
                ],

            ],
        ],
    ]); ?>
<?php Pjax::end() ?>
</div>

<?php
Modal::begin([
    'id'=>'ddPop',
    'size'=>'modal-xs',
   'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  ]);
 echo "<div id='contentDd'></div>";
Modal::end();

Modal::begin([
    'id' => 'dd-modal',
    //'header' => '<h4 class="modal-title">Update</h4>',
    'size'=>'modal-xs',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]); 
Modal::end();

?>
