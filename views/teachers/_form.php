<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $prefixList = ArrayHelper::map(app\models\Prefix::find()->all(), 'id', 'name') ?>
            <?= $form->field($model, 'prefix_id')
                    ->dropDownList($prefixList, ['prompt' => '--select--'])?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?php $facultyList = ArrayHelper::map(app\models\Faculty::find()->all(), 'id', 'name') ?>
            <?= $form->field($model, 'faculty_id')
                    ->dropDownList($facultyList, ['prompt' => '--select--'])?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php $userList = ArrayHelper::map(app\models\User::find()->all(), 'id', 'username') ?>
            <?= $form->field($model, 'user_id')
                    ->dropDownList($userList, ['prompt' => '--select--'])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
