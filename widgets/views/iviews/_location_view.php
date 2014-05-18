<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="location-box bg_white" id="<?= $model->id; ?>">
    <i class="fa fa-quote-left"></i>&nbsp;<?= HtmlPurifier::process($model->party->organisationName); ?> 
    <?php if(!\Yii::$app->request->isAjax && !Yii::$app->user->isGuest): ?>
    <div class="op pull-right">      
      <?= Html::a('Delete',array('/posts/widgetconfig/removelocation','id'=>$model->id),array('class'=>'delete pull-right tipster','title'=>'delete')); ?>
    </div>
    <?php endif; ?>
</div>
<div class="clearfix"></div>
