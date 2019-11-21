<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
                [
                'attribute' => 'prefix_id',
                'value' => function($data) {
                    return $data->prefix['name'];
                }
            ],
            'first_name',
            'last_name',
            [
                'attribute' => 'faculty_id',
                'value' => function($data){
                    return $data->faculty['name'];
                }
            ],
            'address',
            'telephone',
            'email:email',
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user['username'];
                }
            ],
        ],
    ])
    ?>

</div>
