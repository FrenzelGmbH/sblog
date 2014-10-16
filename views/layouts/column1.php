<?php $this->beginContent(\Yii::$app->controller->module->layoutPath . '/' . \Yii::$app->controller->module->layout . '.php'); ?>
<div id="content">
  <div class="cms">
    <?= $content; ?>
  </div>
</div><!-- container -->
<?php $this->endContent(); ?>
