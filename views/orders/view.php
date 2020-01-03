<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">


    <p>
        <?php //echo  Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo  Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'term',
            'year_of_study',
            'created_at:relativeTime',
            'updated_at:relativeTime',
        ],
    ]) ?>
    <hr>
    <h3>รายการที่เบิก</h3>
    <?= GridView::widget([
        'dataProvider' => $detailModels,
        'columns' => [

            'id',
            [
                'attribute' => 'material_id',
                'value' => function($data){
                    return $data->material['name'];
                }
            ],
            'items'

            //['class' => 'app\extensions\grid\ActionColumnMe'],
        ],
    ]); ?>

</div>
