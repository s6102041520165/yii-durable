<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-save"></i> เพิ่มพัสดุ', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-print"></i> สรุปยอดคงเหลือ', ['report'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'types_id',
                'value' => function($data){
                    return $data->types['name'];
                }
            ],
            [
                'attribute' => 'brand_id',
                'value' => function($data){
                    return $data->brand['name'];
                }
            ],
            //'details',
            //'units_id',
            //'price',

            ['class' => 'app\extensions\grid\ActionColumnMe'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
