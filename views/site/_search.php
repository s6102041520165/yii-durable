<?php 
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<?php
$form = ActiveForm::begin([
    'action' => ['materials'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ],
]) ?>
<div class="row">
    <div class="col-lg-3">
        <?php $typeList = ArrayHelper::map(app\models\Types::find()->all(), 'id', 'name') ?>
        <?= $form->field($model, 'types_id')
            ->dropDownList($typeList, ['prompt' => '--select--'])
        ?>
    </div>
    
    <div class="col-lg-3">
        <?php $typeList = ArrayHelper::map(app\models\Brand::find()->all(), 'id', 'name') ?>
        <?= $form->field($model, 'brand_id')
            ->dropDownList($typeList, ['prompt' => '--select--'])
        ?>
    </div>
    
    <div class="col-lg-6">
        <?= $form->field($model, 'name');?>
    </div>
</div>
<?=  Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
<?php ActiveForm::end(); ?>
