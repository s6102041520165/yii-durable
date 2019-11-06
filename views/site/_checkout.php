<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'action'=>['/orders/create']
]); ?>

<?= $form->field($model, 'term')->dropDownList([1=>1,2=>2]) ?>

<?= $form->field($model, 'year_of_study')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('บันทึกข้อมูลเบิก', ['class' => 'btn btn-success'],'visible') ?>
</div>

<?php ActiveForm::end(); ?>