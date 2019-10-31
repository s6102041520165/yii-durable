<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Materials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $typesList = ArrayHelper::map(app\models\Types::find()->all(), 'id', 'name') ?>
            <?= $form->field($model, 'types_id')
                    ->dropDownList($typesList, ['prompt' => '--select--'])?>

    <?php $brandList = ArrayHelper::map(app\models\Brand::find()->all(), 'id', 'name') ?>
            <?= $form->field($model, 'brand_id')
                    ->dropDownList($brandList, ['prompt' => '--select--'])?>

    <?= $form->field($model, 'details')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>

    <?php $unitsList = ArrayHelper::map(app\models\Units::find()->all(), 'id', 'name') ?>
            <?= $form->field($model, 'units_id')
                    ->dropDownList($unitsList, ['prompt' => '--select--'])?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
