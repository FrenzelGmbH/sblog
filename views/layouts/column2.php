<?php $this->beginContent(\Yii::$app->controller->module->layoutPath . '/' . \Yii::$app->controller->module->layout . '.php'); ?>
<div id="content">
  <div class="cms">
    <div class="row">
    	<div class="col-md-3">
    		
    	</div>
    	<div class="col-md-9">
    		<?= $content; ?>
    	</div>
    </div>
  </div>
</div><!-- container -->
<?php $this->endContent(); ?>
