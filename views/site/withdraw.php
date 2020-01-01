<?php
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Withdraw';
$activeButton = ($model->totalCount>0)? TRUE: FALSE;
?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $model,
        'columns' => [

            [
                'attribute' => 'material_id',
                'value' => function($data){
                    return $data->materials['name'];
                }
            ],
            [
                'attribute' => 'items',
                'format' => 'raw',
                'value' => function($data){
                    return Html::beginForm(['/site/withdraw-update/','id'=>$data->id], 'post').
                            Html::input('number', 
                                'items', 
                                $data->items, 
                                [
                                    'class'=>'form-control',
                                    'style'=>'width:100px;text-align:center',
                                    'min' => 0,
                                    'required' => TRUE,
                                    'max' => $data->materials['stock']
                                ]).
                            Html::submitButton("อัพเดท",['class' => 'btn btn-primary btn-sm']).
                            Html::endForm();
                }
            ],
            

            //['class' => 'app\extensions\grid\ActionColumnMe'],
        ],
    ]); ?>
    <?php if($activeButton==TRUE): ?>
    <?=$this->render('_checkout', ['model' => $orderModel,]);?>
    <?php endif; ?>
    
</div>