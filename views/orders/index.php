<?php

use phpDocumentor\Reflection\Types\Array_;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'created_by',
                'value' => function($data){
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
                'value' => function($data){
                    return $data->term."/".$data->year_of_study;
                }
            ],
            'created_at:relativeTime',

            ['class' => 'app\extensions\grid\ActionColumnMe'],
        ],
    ]); ?>


    <?php Pjax::end(); ?>

</div>
