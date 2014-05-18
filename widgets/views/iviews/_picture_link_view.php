<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

?>

<div class="picture-link-box" id="<?= $model->id; ?>">
    <a href="<?= $model->param1_str; ?>" target="_blank">
      <img src="<?= Url::to(['/dms/default/getlatestthumb','id'=>$model->id,'module'=>$model->wgt_table]); ?>" alt="<?= $model->param1_str; ?>" class="img-responsive"/>
    </a> 
    <?php if(!\Yii::$app->request->isAjax && !Yii::$app->user->isGuest): ?>
    <div class="op">
      <?= Html::a('Update',array('/posts/widgetconfig/addpicturelink','id'=>$model->id),array('class'=>'update pull-right tipster','title'=>'update')); ?>
      <?= Html::a('Delete',array('/posts/widgetconfig/removepicturelink','id'=>$model->id),array('class'=>'delete pull-right tipster','title'=>'delete')); ?>
    </div>
    <?php endif; ?>
</div>
<div class="clearfix"></div>
