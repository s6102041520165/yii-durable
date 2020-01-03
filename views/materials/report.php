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
<div class="materials-index" style="font-family: kanit">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'types_id',
                'value' => function ($data) {
                    return $data->types['name'];
                }
            ],
            [
                'attribute' => 'brand_id',
                'value' => function ($data) {
                    return $data->brand['name'];
                }
            ],
            [
                'attribute' => 'stock',
                'value' => function ($data) {
                    return $data->stock . " " . $data->units['name'];
                }
            ],
            'price'
            //'details',
            //'units_id',
            //'price',

            //['class' => 'app\extensions\grid\ActionColumnMe'],
        ],
    ]); ?>
</div>