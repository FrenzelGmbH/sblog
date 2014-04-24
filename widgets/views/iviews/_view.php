<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="post-box">
  <h4 class="fg-color-orange"><?= Html::encode(strtoupper($model->title)); ?>  <small><?= date('Y-m-d h:m',$model->time_create); ?></small></h4>
  <?= $model->content; ?>
</div>

<?php 
  if(class_exists('\app\modules\comments\widgets\PortletCommentsBatch')){
    echo \app\modules\comments\widgets\PortletCommentsBatch::widget(array(
      'module'      =>\app\modules\workflow\models\Workflow::MODULE_BLOG,
      'id'          =>$model->id,
      'title'       => Null,
      'mode' => 'window',
      'htmlOptions' => array('class'=>'nothing'),
    )); 
  }
?>
