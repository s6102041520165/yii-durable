<?php

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

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'created_by',
                'value' => function($data){
                    return $data->creator['username'];
                }
            ],
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
