<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="picture-link-box" id="<?= $model->id; ?>">
    <a href="<?= $model->param1_str; ?>" target="_blank">
      <img src="<?= Url::to(['/dms/default/getthumb','id'=>$model->id]); ?>" alt="<?= $model->param1_str; ?>"/>
    </a> 
    <?php if(!\Yii::$app->request->isAjax && !Yii::$app->user->isGuest): ?>
    <div class="op pull-right">
      <?= Html::a('Delete',array('/posts/widgetconfig/removepicturelink','id'=>$model->id),array('class'=>'delete pull-right tipster','title'=>'delete')); ?>
    </div>
    <?php endif; ?>
</div>
<div class="clearfix"></div>
