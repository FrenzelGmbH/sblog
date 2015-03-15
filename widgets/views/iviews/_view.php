<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="post-box">
  <h4 class="fg-color-orange"><?= Html::encode(strtoupper($model->title)); ?>  <small><?= $model->created_at; ?></small></h4>
  <?= $model->content; ?>
</div>
