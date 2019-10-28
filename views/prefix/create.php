<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prefix */

$this->title = 'Create Prefix';
$this->params['breadcrumbs'][] = ['label' => 'Prefixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefix-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
