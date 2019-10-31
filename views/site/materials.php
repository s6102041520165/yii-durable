<?php 
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'Materials';
?>
<div class="site-materials">
    <a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        ตัวกรอง <span class="fa fa-filter"></span>
    </a>
    <?php Pjax::begin();?>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
            <?=$this->render('_search',['model'=>$searchModel])?>
      </div>
    </div>
    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item_materials',
        'itemOptions' => ['class'=>'list-group-item d-flex justify-content-between align-items-center'],
        'options' => ['class' => 'list-group']
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>