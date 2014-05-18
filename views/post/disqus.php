<?php

use yii\helpers\Html;
use kartik\social\Disqus;

/**
 * @var yii\web\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 */

$this->title = $model->title;

?>

<?php 
    
  echo Disqus::widget(['settings'=>[
    'id' => 'blog_'.$model->id,
    'shortname' => 'simplebutmag',
    'identifier' => 'blog_'.$model->id,
    'url' =>  \Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id]),
  ]]);

?>
