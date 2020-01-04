<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return $data->creator['username'];
                }
            ],
            /*
            [
                'attribute' => 'id',
                'value' => function($data){
                    $a = [];
                    foreach ($data->ordersDetails as $key => $value) {
                       array_push($a,$value);
                    }
                    return var_dump($a[0]);
                }
            ],*/
            [
                'attribute' => 'term',
                'label' => 'เทอม / ปีการศึกษา',
                'value' => function ($data) {
                    return $data->term . "/" . $data->year_of_study;
                }
            ],
            'created_at:relativeTime',

            //['class' => 'app\extensions\grid\ActionColumnMe'],
            [
                'class' => 'app\extensions\grid\ActionColumnMe',
                'template' => '{view} {update} {delete}',
                'contentOptions' => [
                    'noWrap' => true
                ],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        //return var_dump($model->created_by);
                        return Html::button(FA::icon('eye'), ['id' => 'modelButton' . $model->id, 'data-uri' => \yii\helpers\Url::toRoute(['orders/view', 'id' => $model->id]), 'style' => 'padding:0', 'class' => 'btn btn-link text-secondary']);
                        //return Html::button('Create List', ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['list/create']), 'class' => 'btn btn-success']);
                    },
                ]
            ]

        ],
    ]); ?>



    <?php

    Modal::begin([
        'title' => 'Hello world',
        //'toggleButton' => ['label' => 'click me'],
        'size' => 'modal-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();

    ?>


    <?php


    foreach ($dataProvider->models as $data) {
        $this->registerJs("
        $(function(){
            $('#modelButton$data->id').click(function(){
                $('.modal').modal('show')
                    .find('#modelContent')
                    .load($(this).attr('data-uri'));
                $('.modal-title').html('รหัสการเบิกที่ $data->id');
            });
        });
        ", View::POS_END, $data->id);
    }

    ?>

</div>