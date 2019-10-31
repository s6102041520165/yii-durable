<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
    ]);
    ?>
    <div class="row">
        
        <div class="col-lg-4">
            <?php $userList = ArrayHelper::map(app\models\Users::find()->all(), 'id', 'username') ?>
            <?= $form->field($model, 'created_by')
                    ->dropDownList($userList, ['prompt' => '--select--'])
            ?>
        </div>
        <div class="col-lg-1">
            <?= $form->field($model, 'term') ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'year_of_study') ?>
        </div>
            <?php
            /*
             * 
            foreach ($model as $teach) {
                echo $teach->feils_name;
            }
            /**/
            ?>
        <?php //echo $form->field($model, 'created_at')  ?>

            <?php // echo $form->field($model, 'updated_at')  ?>

            <?php // echo $form->field($model, 'amount_item') ?>
        <div class="col-lg-4" style="margin-top: 30px">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?>
        </div>
    </div>



<?php ActiveForm::end(); ?>

</div>
