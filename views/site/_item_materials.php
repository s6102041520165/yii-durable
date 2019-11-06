<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?> 
<?php 
$badgeColor = ($model->stock>0)?'badge-primary':'badge-danger';
$disableButton = ($model->stock>0)? FALSE: TRUE;
?>
<?=$model->name;?> 
<style>
    form{
        display: inline-block;
    }
</style>
<div>
    <span class="badge <?=$badgeColor;?> badge-pill"><?=$model->stock;?> <?=$model->units['name']?></span>
    <?php $form = ActiveForm::begin(
        [
            'action' => ['add-withdraw','id'=>$model->id],
            'method' => 'post',
        ]
    );  ?>
    <?=Html::submitButton(Html::tag('span', '', ['class'=>'fa fa-plus'])." เบิก",['class'=>"btn btn-success",'disabled'=>$disableButton]);?>
    <?php ActiveForm::end() ?>
</div>