<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Materials */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="materials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'details',
            [
                'attribute' => 'stock',
                'value' => function($data){
                    return $data->stock." ".$data->units['name'];
                }
            ],
            [
                'attribute' => 'price',
                'value' => function($data){
                    return $data->price." บาท";
                }
            ],
        ],
    ]) ?>

</div>
