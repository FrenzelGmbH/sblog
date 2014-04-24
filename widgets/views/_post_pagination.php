<?php

use yii\helpers\Html;

?>

<div class="clearfix"></div>

<div class="btn btn-default prev-btn">
  <?php 
    echo Html::a('previous',['/posts/post/onlineview','id'=>$model->previousPost->id]);
  ?>
</div>

<div class="btn btn-default next-btn pull-right">
  <?php 
    echo Html::a('next',['/posts/post/onlineview','id'=>$model->nextPost->id]);
  ?>
</div>
