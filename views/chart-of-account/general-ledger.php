<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ChartOfAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'General Ledger (GL)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chart-of-account-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'classification',
            [
                'attribute'=> 'Amount',
                'format'=> 'raw',
                'value' => function ($data) {
                    return $data->getSumChartOfAccount($data->id);

                },

            ],

            ['class' => 'yii\grid\ActionColumn',

                'template' => '{view}',
                'header' => "Menu",
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'view-training', 
                            'class'=>'glyphicon glyphicon-eye-open',
                            'target'=>'_blank',
                            ]);
                    },
                ],
                 'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                        $url = \Yii::$app->getUrlManager()->createUrl(["account-transaction/sub-ledger", 'id' => $model->id]);
                        return $url;
                        }
                    }                 
            ],
            
        ],
    ]); ?>


</div>
