<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$arr = array();
$arr = explode("READMORE",$model->content,2);
$content = $arr[0];

?>

<div class="post-box">
  
  <div class="post-header">
    <div class="datebox pull-left c_gray">
      <?= date("M", strtotime($model->time_create)); ?><br>
      <?= date("d", strtotime($model->time_create)); ?>
    </div>
    <h1 class="lspace subline"><a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>" class="c_black"><?= Html::encode(strtoupper($model->title)); ?></a></h1>
  </div>
  
  <div class="post-content">
    <?= $content; ?>

    <?php if(count($arr)>1): ?>
      <div class="fa fa-arrow-right"></div> <a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>" class="c_black"><?= Html::encode(strtoupper('read the full story here..')); ?></a>
    <?php endif; ?>

    <?= frenzelgmbh\sblog\widgets\WidgetBlogMapRender::widget(array(
    'module'=> app\modules\workflow\models\Workflow::MODULE_BLOG,
    'id'    => $model->id
  )); ?> 

  </div>
  
  <div class="post-footer">
    <?= $model->TagLinks; ?>
    <div class="pull-right">
      <a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>#commentreference"><?= 'Comments'; ?></a>
    </div>
  </div>

</div>