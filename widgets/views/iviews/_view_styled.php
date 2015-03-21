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
      <?= $model->created_at; ?>
    </div>
    <h3 class="lspace"><a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>" class="c_black"><?= Html::encode(strtoupper($model->title)); ?></a></h3>
  </div>
  
  <div class="post-content">
    <?= $content; ?>

    <?php if(count($arr)>1): ?>
      <div class="fa fa-arrow-right"></div> <a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>" class="c_black"><?= Html::encode(strtoupper('read the full story here..')); ?></a>
    <?php endif; ?>

    <?= frenzelgmbh\sblog\widgets\WidgetBlogMapRender::widget(array(
    'module'=> '1',
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