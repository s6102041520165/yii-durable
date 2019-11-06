<?php

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
            [
                'attribute' => 'created_by',
                'value' => function($data){
                    //print_r($data->creator);
                    return $data->creator['first_name']." ".$data->creator['last_name'];
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($data){
                    return $data->updator['first_name']." ".$data->updator['last_name'];
                }
            ],
            'term',
            'year_of_study',
            'created_at:relativeTime',
            'updated_at:relativeTime',
        ],
    ]) ?>

</div>
