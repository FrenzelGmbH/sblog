<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="location-box bg_white" id="<?= $model->id; ?>">
    <i class="fa fa-quote-left"></i>&nbsp;<?= HtmlPurifier::process($model->party->organisationName); ?> 
    <div class="op pull-right">
      <?php if(!\Yii::$app->request->isAjax && !Yii::$app->user->isGuest): ?>
        <?= Html::a('Delete',array('/posts/widgetconfig/removelocation','id'=>$model->id),array('class'=>'delete pull-right tipster','title'=>delete)); ?>
      <?php endif; ?>
    </div>
</div>
<div class="clearfix"></div>
