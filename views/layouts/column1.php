<?php $this->beginContent(\Yii::$app->controller->module->layoutPath . '/' . \Yii::$app->controller->module->layout . '.php'); ?>
    <div class="container">
        <?= $content ?>
    </div>
<?php $this->endContent(); ?>
